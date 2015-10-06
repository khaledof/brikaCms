<!--
listTemplate
-->
<script id="listTemplate" type="text/template">
    <% if(itemsList.length > 0) { %>
    <div class="table-responsive ma5">
        <!-- panel body with collapse capabale -->
        <div id="tableHolder" class="table-responsive panel-collapse pull out">
            <table id="table1" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>
                    <th width="2%">Détail</th>
                    <th>Prénom & Nom</th>
                    <th>Email</th>
                    <th>Date</th>
                    @if(Auth::user()->can('contacts_manage'))<th width="4%" class="text-center"></th>@endif
                    <th class="hidden-xs" width="4%">Id</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!--/ panel body with collapse capabale -->
    </div>
    <% }else{ %>
    <div class="col-sm-12">
        <div class="alert alert-danger center">
            No item is availibale
        </div>
    </div>
    <%}%>
</script>
<!--
rowTemplate
-->
<script id="rowTemplate" type="template">
    <td>
        <div class="checkbox custom-checkbox nm">
            <input type="checkbox" id="customcheckbox-one<%= id %>" value="1" data-itemid="<%= id %>" data-toggle="selectrow" data-target="tr" data-contextual="info">
            <label for="customcheckbox-one<%= id %>"></label>
        </div>
    </td>
    <td><a href="javascript:void(0)" class="btnQuickEdit"><i class="fa fa-search-plus"></i></a></td>
    <td><%= name %></td>
    <td><%= email %></td>
    <td><%= moment(created_at).format('L') %></td>
    @if(Auth::user()->can('contacts_manage'))<td><a href="javascript:void(0);" class="text-danger btnDeleteModal"><i class="icon ico-remove3"></i></a></td>@endif
    <td class="hidden-xs"><%= id %></td>
</script>
