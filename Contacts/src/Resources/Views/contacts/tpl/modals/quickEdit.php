<!--
quickEditModalTemplate
-->
<script id="quickEditModalTemplate" type="text/template">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="cell text-center">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="semibold text-primary"><%= name %></h4>
                </div>
            </div>
            <div class="modal-body">
                <table width:"100%">
                <tbody>

                <tr>
                    <td width="50%" width="50%"><b>Date :</b></td>
                    <td width="50%"><%= moment(created_at).format('LLL') %></td>
                </tr>
                <tr>
                    <td width="50%"><b>Email:</b></td>
                    <td width="50%"><%= email %></td>
                </tr>
                <tr>
                    <td width="50%"><b>Société:</b></td>
                    <td width="50%"><%= company %></td>
                </tr>
                <tr>
                    <td width="50%"><b>Téléphone:</b></td>
                    <td width="50%"><%= phone %></td>
                </tr>
                <tr>
                    <td width="50%"><b>Message:</b></td>
                    <td width="50%"><%= msg %></td>
                </tr>
                </tbody>
                </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</script>