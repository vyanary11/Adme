<div class="modal fade" id="{{$modal}}" tabindex="-1" aria-labelledby="{{$modal}}eModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-{{$size}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$modal}}modalLabel">{{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="loading-modal">
                    <div class="empty-state">
                        <div class="empty-state-icon bg-transparent">
                            <i class="text-dark fas fa-circle-notch fa-spin"></i>
                        </div>
                        <h2>Loading.....</h2>
                    </div>
                </div>
                <div id="content">
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#content").hide();
    $('.loading-modal').show();
</script>
