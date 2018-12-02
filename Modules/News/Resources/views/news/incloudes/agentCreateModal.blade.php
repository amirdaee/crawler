<div class="modal fade" tabindex="-1" role="dialog" id="create-agent-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ساخت خبرگزاری جدید</h4>
            </div>
            <form method="POST" action="{{ route('agent.store') }}" id="create_agent">
                <div class="modal-body">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <strong>نام خبرگزاری:</strong>
                                <input name="name" type="text" placeholder="نام خبرگزاری" class="form-control">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="comment">لینک پایه:</label>
                                <textarea name="base_url" class="form-control" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="task_url">لینک صفحه اخبار جدید:</label>
                                <textarea name="task_url" class="form-control" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="task_filter">مسیر لینک ها</label>
                                <textarea name="task_filter" class="form-control" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="title_filter">مسیر عنوان خبر:</label>
                                <textarea name="title_filter" class="form-control" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="content_filter">مسیر متن خبر:</label>
                                <textarea name="content_filter" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary pull-right">ذخیره</button>
                    <a class="btn btn-danger pull-left" href="{{ route('agent.index') }}"> انصراف</a>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
