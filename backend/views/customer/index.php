<?php
    use yii\helpers\Url;
?>
<table id="customer_table" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
             <th style="width:5%">
                <input class="ace cb_all" type="checkbox">
                <span class="lbl">&nbsp;</span>
            </th>
            <th>Tên</th>
            <th> Mã khách hàng</th>
            <th> Địa chỉ</th>
            <th> Số điện thoại</th>
            <th> Số fax</th>
            <th> Trang web</th>
            <th> Mã số thuế</th>
            <th style="width:15%">Thao tác</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    var table = $('#customer_table').DataTable( {
        dom: 'Bfrtip',
        "oLanguage": {
           "sLengthMenu": "Hiện _MENU_ mục",
            "sSearch": "Tìm kiếm:",
            "oPaginate": {
                "sPrevious": "Trước",
                "sNext": "Kế tiếp"
            },
            "sEmptyTable": "Không có dữ liệu",
            "sProcessing": "Đang tải dữ liệu...",
            "sZeroRecords": "Không tìm thấy dữ liệu phù hợp",
             "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
            "sInfoEmpty": "Hiển thị 0 đến 0 của 0 mục",
             "sInfoFiltered": "(filtered của _MAX_ tồng số trong mục)",
            "sInfoPostFix": "",
            "sUrl": ""
        },
        "aaSorting" : [[1, 'desc']],
        "columnDefs": [
                        {"targets": 0, "orderable": false},
                        {"targets": 1, "orderable": false},
                        {"targets": 2, "orderable": false},
                        {"targets": 3, "orderable": false},
                        {"targets": 4, "orderable": false},
                        {"targets": 5, "orderable": false},
                        {"targets": 6, "orderable": false},
                        {"targets": 7, "orderable": false},
                        {"targets": 8, "orderable": false},
                      ],
        "processing": true,
        "serverSide": true,
        "ajax": $.fn.dataTable.pipeline( {
            url: '<?= Url::to(['customer/load-data'])?>',
            pages: 5
        } ),
        select: true,
        buttons: [
            {
                'text' : 'Create',
                'action' : function(e,dt,node,config){
                    Create();
                }
            },{
                'extend' : 'selectedSingle',
                'text' : 'Edit',
                'action' : function(e,dt,node,config){
                    var id = dt.rows( { selected: true } ).data().pluck('id')[0];
                    Edit(id);
                }
            },{
                'extend' : 'selectedSingle',
                'text' : 'Delete',
                'action' : function(e,dt,node,config){
                    var id = dt.rows( { selected: true } ).data().pluck('id')[0];
                    Edit(id);
                }
            }
        ],
        'bSort' : false
    });
    function Create(){
        alert('create');
    }
    function Edit(id){
        alert(id);
    }
    function Delete(id){
        alert(id);
    }
</script>