{{-- 
    Edit post modal    
--}}

{{--                   PARAMETERS 
  * Model Post @post - The post model
    
    *required
--}}
<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModal" aria-hidden="true">
    <div class="modal-dialog m-0 mx-md-auto my-md-4">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Editar publicação</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="editPostModalContent">
            Carregando...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            @include('templates.form.submit', ['name' => 'Salvar', 'class' => 'btn-primary', 'attributes' => ['onclick' => "$('#post-update-form').submit()"]])
            </form>
        </div>
        </div>
    </div>
</div>