<div class="modal fade" id="{{$name}}-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="{{$name}}" action="{{$route}}" method="post" class="needs-validation" novalidate="">
        <div class="modal-dialog modal-lg">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{$name}}-modalLabel">{{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="loading-modal">
                        <div class="empty-state">
                            <div class="empty-state-icon bg-transparent">
                                <i class="text-dark fas fa-circle-notch fa-spin"></i>
                            </div>
                            <h2>Loading.....</h2>
                        </div>
                    </div>
                    <div class="content-modal">
                        {{$slot}}
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" name="{{$name}}-buttonSubmit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
