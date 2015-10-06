<!--
deleteModalTemplate
-->
<script id="deleteModalTemplate" type="template">
    <div class="modal-dialog">
        <form class="modal-content" action="">
            <div class="modal-header">
                <div class="cell text-center">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="semibold text-primary">Confirmation de la Suppression</h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5>Voulez-vous vraiment supprimer le(s) élément(s) ?</h5>
                        <ul class="unstyled">
                            <% _.each(items, function(element) { %>
                            <li><%= element.name %></li>
                            <% }) %>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-danger btnConfirmDelete">Supprimer</button>
            </div>
            <input type="hidden" name="itemsToDelete" id="itemsToDelete" value="<%= str %>">
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</script>