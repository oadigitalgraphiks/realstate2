<?php

namespace App\Utility;

use App\Models\Menu;

class MenuUtility
{
    /*when with trashed is true id will get even the deleted items*/
    public static function get_immediate_children($id, $with_trashed = false, $as_array = false)
    {
        $children = $with_trashed ? Menu::where('parent_id', $id)->where('status', 0)->orderBy('position', 'acs')->get() : Menu::where('parent_id', $id)->where('status', 0)->orderBy('position', 'asc')->get();
        $children = $as_array && !is_null($children) ? $children->toArray() : array();

        return $children;
    }

    public static function get_immediate_children_ids($id, $with_trashed = false)
    {

        $children = MenuUtility::get_immediate_children($id, $with_trashed, true);

        return !empty($children) ? array_column($children, 'id') : array();

    }

    public static function get_immediate_children_count($id, $with_trashed = false)
    {
        return $with_trashed ? Menu::where('parent_id', $id)->count() : Menu::where('parent_id', $id)->count();
    }

    /*when with trashed is true id will get even the deleted items*/
    public static function flat_children($id, $with_trashed = false, $container = array())
    {
        $children = MenuUtility::get_immediate_children($id, $with_trashed, true);

        if (!empty($children)) {
            foreach ($children as $child) {

                $container[] = $child;
                $container = MenuUtility::flat_children($child['id'], $with_trashed, $container);

            }
        }

        return $container;
    }

    /*when with trashed is true id will get even the deleted items*/
    public static function children_ids($id, $with_trashed = false)
    {
        $children = MenuUtility::flat_children($id, $with_trashed = false);

        return !empty($children) ? array_column($children, 'id') : array();
    }

    public static function move_children_to_parent($id)
    {
        $children_ids = MenuUtility::get_immediate_children_ids($id, true);

        $menu = Menu::where('id', $id)->first();

        MenuUtility::move_level_up($id);

        Menu::whereIn('id', $children_ids)->update(['parent_id' => $menu->parent_id]);

    }

    public static function move_level_up($id){
        if (MenuUtility::get_immediate_children_ids($id, true) > 0) {
            foreach (MenuUtility::get_immediate_children_ids($id, true) as $value) {
                $menu = Menu::find($value);
                $menu->level -= 1;
                $menu->save();
                return MenuUtility::move_level_up($value);
            }
        }
    }

    public static function move_level_down($id){
        if (MenuUtility::get_immediate_children_ids($id, true) > 0) {
            foreach (MenuUtility::get_immediate_children_ids($id, true) as $value) {
                $menu = Menu::find($value);
                $menu->level += 1;
                $menu->save();
                return MenuUtility::move_level_down($value);
            }
        }
    }

    public static function delete_menu($id)
    {
        $menu = Menu::where('id', $id)->first();
		//dd($id);
        if (!is_null($menu)) {
           // MenuUtility::move_children_to_parent($menu->id);
            $menu->delete();
        }

    }
}
