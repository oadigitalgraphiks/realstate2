<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Slider;
use App\Models\SliderTranslation;
use App\Models\Upload;
use Illuminate\Http\Request;
use Requests;

class SlidersController extends Controller
{

    protected $current_route;

    public function __construct()
    {
        $this->current_route = \Request::route()->getName();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menu_id = getMenuIdForPermission($this->current_route);

        if(auth()->user()->user_type != 'admin' && !menu_permissions($menu_id)){
            return redirect()->route('backend.no-rights');
        }

        $sort_search =null;
		$categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->orderBy('name','asc')
            ->get();
		$brands = Brand::orderby('name','ASC')->get();
        $sliders = Slider::paginate(15);
        if ($request->has('search')){
            $sort_search = $request->search;
            $sliders = Slider::where('title1', 'like', '%'.$sort_search.'%')->paginate(15);
        }
        return view('slider.index',compact('sliders','sort_search','categories','brands'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $slider = new Slider;
        $slider->title1 =   $request->title1;
        $slider->title2 =   $request->title2;
        $slider->button_text    =   $request->button_text;
        $slider->status =   0;
        $slider->type   =   $request->type;
        if ($request->type == 'category') {
            $slider->category_id = $request->category_id;
        }
        if ($request->type == 'brand') {
            $slider->brand_id = $request->brand_id;
        }
        if ($request->type = 'custom') {
            $slider->link   =   $request->link;
        }
        if ($request->sorting_id != null ) {
            $slider->sorting_id = $request->sorting_id;
        }else{
            $slider->sorting_id =   0;
        }
        // photo
        if (isset($request->photo)) {
            $photo = Upload::where('id',$request->photo)->first();
            if ($photo->width == env('SLIDER_IMAGE_WIDTH') && $photo->height == env('SLIDER_IMAGE_HEIGHT') && $photo->size <=
            env('SLIDER_IMAGE_SIZE')) {
                $slider->photo = $request->photo;
            }
            else{
                flash(translate('Photo Image Not Correct size. Try Again'))->error();
            }
        }
        // mobile
        if (isset($request->mobile_photo)) {
            $mobile_photo = Upload::where('id',$request->mobile_photo)->first();
            if ($mobile_photo->width == env('MOBILE_SILDER_IMAGE_WIDTH') && $mobile_photo->height == env('MOBILE_SILDER_IMAGE_HEIGHT') && $mobile_photo->size <= env('MOBILE_SILDER_IMAGE_SIZE')) {
                $slider->mobile_photo = $request->photo;
            }
            else{
                flash(translate('Mobile Image Not Correct size. Try Again'))->error();
            }
        }
        // dd($slider);
        $slider->save();

        $slider_translation =  SliderTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'slider_id' => $slider->id]);
        $slider_translation->slider_id  =   $slider->id;
        if ($request->status != null) {
            $slider_translation->status     =   $request->status;
        }else{
            $slider_translation->status     =   'inactive';
        }
        $slider_translation->title1 = $request->title1;
        $slider_translation->title2 = $request->title2;
        $slider_translation->button_text = $request->button_text;
        if (isset($request->photo)) {
            $photo = Upload::where('id',$request->photo)->first();
            if ($photo->width == env('SLIDER_IMAGE_WIDTH') && $photo->height == env('SLIDER_IMAGE_HEIGHT') && $photo->size <=
            env('SLIDER_IMAGE_SIZE')) {
                $slider_translation->photo = $request->photo;
            }
            else{
                flash(translate('Photo Image Not Correct size. Try Again'))->error();
            }
        }
        if (isset($request->mobile_photo)) {
            $mobile_photo = Upload::where('id',$request->mobile_photo)->first();
            if ($mobile_photo->width == env('MOBILE_SILDER_IMAGE_WIDTH') && $mobile_photo->height == env('MOBILE_SILDER_IMAGE_HEIGHT') && $mobile_photo->size <= env('MOBILE_SILDER_IMAGE_SIZE')) {
                $slider_translation->mobile_photo = $request->mobile_photo;
            }
            else{
                flash(translate('Mobile Image Not Correct size. Try Again'))->error();
            }
        }
        $slider_translation->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $menu_id = getMenuIdForPermission($this->current_route);

        if(auth()->user()->user_type != 'admin' && !frontend_permissions($this->current_route)){
            return redirect()->route('backend.no-rights');
        }

        $lang   = $request->lang;
       $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->orderBy('name','asc')
            ->get();
		$brands = Brand::orderby('name','ASC')->get();
        $slider =   Slider::findOrFail($id);
        return view('slider.edit',compact('slider','lang','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $slider =   Slider::findorfail($id);
        if ($request->lang == env('DEFAULT_LANGUAGE')) {
            # code...
            $slider->title1 =   $request->title1;
            $slider->title2 =   $request->title2;
            $slider->button_text    =   $request->button_text;
            if ($request->status) {
                $slider->status =   $request->status;
            }
            $slider->type   =   $request->type;

            if($request->type == 'category'){
                $slider->category_id = $request->category_id;
            }else{
                $slider->category_id = null;
            }
            if($request->type == 'brand'){
                $slider->brand_id = $request->brand_id;
            }else{
                $slider->brand_id = null;
            }
            if($request->type == 'custom'){
                $slider->link   =   $request->link;
            }else{
                $slider->link = null;
            }

            if ($request->sorting_id != null ) {
                $slider->sorting_id = $request->sorting_id;
            }else{
                $slider->sorting_id =   0;
            }
            // photo
            if (isset($request->photo)) {
                $photo = Upload::where('id',$request->photo)->first();
                if ($photo->width == env('SLIDER_IMAGE_WIDTH') && $photo->height == env('SLIDER_IMAGE_HEIGHT') && $photo->size <= env('SLIDER_IMAGE_SIZE')) {
                    $slider->photo = $request->photo;
                }
                else{
                    flash(translate('Photo Image Not Correct size. Try Again'))->error();
                }
            }else{
                $slider->photo = $request->photo;
            }
            // mobile
            if (isset($request->mobile_photo)) {
                $mobile_photo = Upload::where('id',$request->mobile_photo)->first();
                if ($mobile_photo->width == env('MOBILE_SILDER_IMAGE_WIDTH') && $mobile_photo->height == env('MOBILE_SILDER_IMAGE_HEIGHT') && $mobile_photo->size <= env('MOBILE_SILDER_IMAGE_SIZE')) {
                    $slider->mobile_photo = $request->mobile_photo;
                }
                else{
                    flash(translate('Mobile Image Not Correct size. Try Again'))->error();
                }
            }else{
                $slider->mobile_photo = $request->mobile_photo;
            }
            $slider->save();
        }
        $slider_translation =   SliderTranslation::firstOrNew(['lang' => $request->lang, 'slider_id'=>$slider->id]);
		$slider_translation->slider_id =  $slider->id;
        $slider_translation->title1 =   $request->title1;
        $slider_translation->title2 =   $request->title2;
        $slider_translation->button_text =   $request->button_text;
        // $slider_translation->link   =   $request->link;
        // photo
        if (isset($request->photo)) {
            $d_photo = Upload::where('id',$request->photo)->first();
            if ($d_photo->width == env('SLIDER_IMAGE_WIDTH') && $d_photo->height == env('SLIDER_IMAGE_HEIGHT') && $d_photo->size <= env('SLIDER_IMAGE_SIZE')) {
                $slider_translation->photo = $request->photo;
            }
            else{
                flash(translate('Photo Image Not Correct size. Try Again'))->error();
            }
        }else{
            $slider_translation->photo = $request->photo;
        }
        // mobile
        if (isset($request->mobile_photo)) {
            $m_photo = Upload::where('id',$request->mobile_photo)->first();
            if ($m_photo->width == env('MOBILE_SILDER_IMAGE_WIDTH') && $m_photo->height == env('MOBILE_SILDER_IMAGE_HEIGHT') && $m_photo->size <= env('MOBILE_SILDER_IMAGE_SIZE')) {
                $slider_translation->mobile_photo = $request->mobile_photo;
            }
            else{
                flash(translate('Mobile Image Not Correct size. Try Again'))->error();
            }
        }else{
            $slider_translation->mobile_photo = $request->mobile_photo;
        }
        $slider_translation->status =   $request->status;
        $slider_translation->save();
        // dd($request->photo);

        flash(translate('Slider has been updated successfully'))->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu_id = getMenuIdForPermission($this->current_route);

        if(auth()->user()->user_type != 'admin' && !frontend_permissions($this->current_route)){
            return redirect()->route('backend.no-rights');
        }

        $slider = Slider::findOrFail($id);
        foreach ($slider->slider_translations as $key => $slider_translation) {
            $slider_translation->delete();
        }
        Slider::destroy($id);

        flash(translate('Slider has been deleted successfully'))->success();
        return back();
    }

    public function updateStatus(Request $request)
    {
        $slider = Slider::findOrFail($request->id);
        $slider->status = $request->status;
        if($slider->save()){
            return 1;
        }
        return 0;
    }
}
