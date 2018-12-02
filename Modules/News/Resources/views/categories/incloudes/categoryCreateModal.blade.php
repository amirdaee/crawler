<div class="modal fade" tabindex="-1" role="dialog" id="create-category-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">دسته جدید</h4>
            </div>
            <form method="POST" action="{{ route('categories.store') }}" id="create_category">
                <div class="modal-body">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <strong>نام دسته:</strong>
                                <input name="name" type="text" placeholder="نام دسته" class="form-control">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="parent_id">مادر دسته</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">-----</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        {{ csrf_field() }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary pull-right">ذخیره</button>
                    <a class="btn btn-danger pull-left" href="{{ route('categories.index') }}"> انصراف</a>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
