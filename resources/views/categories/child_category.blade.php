@php
    $value = null;
    for ($i=0; $i < $child_category->level; $i++){
        $value .= '--';
    }
@endphp
<option value="{{ $child_category->id }}" 
    @isset($home_categorie) 
        {{$home_categorie == $child_category->id ? 'selected' : ''}} 
    @endisset 
    @isset($product->category_id) 
        @if($product->category_id == $child_category->id) selected @endif 
    @endisset>
        {{ $value." ".$child_category->getTranslation('name') }}
</option>

@if ($child_category->categories)
    @foreach ($child_category->categories as $childCategory)
        @include('categories.child_category', ['child_category' => $childCategory])
    @endforeach
@endif
