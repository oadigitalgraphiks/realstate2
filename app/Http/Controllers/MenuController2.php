<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Models\Category;
use App\Models\Mainmenu;
use App\Models\Menu;
use App\Models\MenuTranslation;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Requests;
use DB;

class MenuController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuitems = '';
        $desiredMenu = '';
        $id = 1;
        if (isset($_GET['id']) && $_GET['id'] != 'new') {
            $id = $_GET['id'];
            $desiredMenu = Mainmenu::where('id', $id)->first();
            if (!empty($desiredMenu)) {
                $menuitems = Menu::where('menu_id', $desiredMenu->id)->orderby('position', 'ASC')->get();
                $menu_ul = '<ul id="easymm"></ul>';
                if ($menuitems) {
                    foreach ($menuitems as $row) {
                        $this->add_row(
                            $row->id,
                            $row->parent_id,
                            ' id="menu-' . $row->id . '" class="sortable" ',
                            $this->get_label($row)
                        );
                    }
                    $menu_ul = $this->generate_list('id="easymm"');
                }
            }
        } else {
            $desiredMenu = Mainmenu::orderby('id', 'ASC')->first();
            if ($desiredMenu) {
                if (!empty($desiredMenu)) {
                    $menuitems = Menu::where('menu_id', $desiredMenu->id)->orderby('position', 'ASC')->get();
                    if (count($menuitems) <= 0) {
                        $menuitems = [];
                    }
                    $menu_ul = $this->generate_list('id="easymm"');
                    $id = 1;
                }
            }
        }

        return view('manage_menu.index', ['categories' => Category::all(), 'menus' => Mainmenu::all(), 'desiredMenu' => $desiredMenu, 'menuitems' => $menuitems, 'group_id' => $id, 'menu_ul' => $menu_ul]);
    }


    function add_row($id, $parent, $li_attr, $label)
    {
        $this->data[$parent][] = array('id' => $id, 'li_attr' => $li_attr, 'label' => $label);
    }
    function generate_list($ul_attr = '')
    {
        //dd($ul_attr);
        return $this->ul(0, $ul_attr);
    }
    private function get_label($row)
    {
        $disabled = '';
        if ($row->status == 1) {
            $disabled = 'style="background: linear-gradient(#f37373, #fb7d7d);"';
        }
        $label = '<div class="ns-row" ' . $disabled . '>' .
            '<div class="ns-title">' . $row->name . '</div>' .
            '<div class="ns-url">' .  ($row->type == "custom" ? $row->url : "") . '</div>' .
            '<div class="actions">' .
            '<a href="javascript:;" class="edit-menu" data-menu-id=' . $row->id . ' title="Edit" data-menu-id="' . $row->id . '">' .
            '<span class="las la-edit" style="color: #444"></span></a>' .
            '</a>' .
            '<a href="javascript:;" class="  confirm-delete" title="Delete" data-href="' . route('menu.destroy', $row->id) . '">' .
            '<span class="las la-trash" style="color: red"></span>' .
            '</a>' .
            '</div>' .
            '</div>';
        return $label;
    }
    function ul($parent = 0, $attr = '')
    {
        static $i = 1;
        $indent = str_repeat("\t\t", $i);
        if (isset($this->data[$parent])) {
            if ($attr) {
                $attr = ' ' . $attr;
            }
            $html = "\n$indent";
            $html .= "<ul$attr>";
            $i++;
            foreach ($this->data[$parent] as $row) {
                $child = $this->ul($row['id']);
                $html .= "\n\t$indent";
                $html .= '<li' . $row['li_attr'] . '>';
                $html .= $row['label'];
                if ($child) {
                    $i--;
                    $html .= $child;
                    $html .= "\n\t$indent";
                }
                $html .= '</li>';
            }
            $html .= "\n$indent</ul>";
            return $html;
        } else {
            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function update2()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if (Menu::create($data)) {
            $newdata = Menu::orderby('id', 'DESC')->first();
            flash(translate('Menu saved successfully !'))->success();
            return redirect("admin/manage-menus?id=$newdata->id");
        } else {
            flash(translate('Menu saved successfully !'))->error();
            return back();
        }
    }

    public function addCatToMenu(Request $request)
    {
        // $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = Menu::findOrFail($menuid);
        if ($menu->content == null) {
            foreach ($ids as $id) {
                $menuItem   =  new MenuItem;
                $menuItem->title = Category::where('id', $id)->value('name');
                $menuItem->slug = Category::where('id', $id)->value('slug');
                $menuItem->type = 'category';
                $menuItem->menu_id = $menuid;
                $menuItem->save();
            }
        } else {
            foreach ($ids as $id) {
                $olddata = json_decode($menu->content, true);
                $menuItem   =  MenuItem::find($id);
                $menuItem->title = Category::where('id', $id)->value('name');
                $menuItem->slug = Category::where('id', $id)->value('slug');
                $menuItem->type = 'category';
                $menuItem->menu_id = $menuid;
                $lastdata = $menuItem->save();
                $newdata = [];
                $newdata['id'] = $lastdata->id;
                $newdata['children'] = [[]];
                array_push($olddata[0], $newdata);
                $olddata = json_encode($olddata);
                $menu->update(['content' => $olddata]);
            }
        }
    }

    public function updateMenu(Request $request)
    {
        $newdata = $request->all();
        $menu    =  Menu::findOrFail($request->menuid);
        $content = $request->data;
        $newdata = [];
        $newdata['location'] = $request->location;
        $newdata['content'] = json_encode($content);
        $menu->update($newdata);
    }

    public function updateMenus(Request $request)
    {
        if (!empty($request)) {
            // dd($request->menu);
            foreach ($request->menu as $k => $v) {
                if ($v == 'null') {
                    $menu2[0][] = $k;
                    //dd($menu2);
                } else {
                    $menu2[$v][] = $k;
                }
                //dd($menu2);
            }
            $success = 0;
            if (!empty($menu2)) {
                foreach ($menu2 as $k => $v) {
                    $i = 1;
                    foreach ($v as $v2) {
                        $data['parent_id'] = $k;
                        $data['position'] = $i;
                        // dd($data);
                        if ($this->update($data, $v2)) {
                            $success++;
                        }
                        $i++;
                        //flash(translate('Menu has been updated successfully'))->success();
                    }
                }
            }
        }
    }


    public function update($request, $id)
    {
        // DB::table('menus')
        //            ->where('id', $id)
        //            ->update(['parent_id' =>  $request]);

        DB::table('menus')
            ->where('id', $id)
            ->update($request);
    }
}
