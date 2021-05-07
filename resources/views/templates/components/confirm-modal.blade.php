{{-- 
    Click confirmation modal
--}}

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
    <div class="modal-dialog m-0 mx-md-auto my-md-4">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-confirm-title">Atenção</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p id="modal-confirm-content">Deseja realizar a ação?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
            <button type="button" class="btn btn-success" id="modal-confirm-yes">Sim</button>
        </div>
        </div>
    </div>
</div>