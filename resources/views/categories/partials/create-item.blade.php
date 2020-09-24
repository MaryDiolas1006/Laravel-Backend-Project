<div class="row">
    <div class="col-12">
        <h4 class="text-center lead my-4">
            Create {{$category->name}} Item
        </h4>
    </div>
</div>

{{-- item section --}}
<div class="row">
    <div class="col-12">
        {{-- add item form --}}
        <form action="{{ route('subjects.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- item name --}}
            @include('subjects.partials.form-group',[
                'name' => 'name',
                'type' => 'text',
                'classes' => ['form-control'],
                'required' => "required"
            ])

            {{-- item model --}}
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" class="form-control" disabled>
                    <option value="{{$category->id}}">{{$category->name}}</option>
                </select>
                <input type="hidden" name="category_id" id="category_id" value="{{$category->id}}">
            </div>

            {{-- image --}}
            @include('subjects.partials.form-group',[
                'name' => 'image',
                'type' => 'file',
                'classes' => ['form-control-file', 'form-control-sm', 'imageButton']
            ])

            <button class="btn btn-block btn-primary my-3"> Add Item</button>

        </form>
        {{-- add item form end --}}
    </div>
</div>
{{-- add item section end --}}
