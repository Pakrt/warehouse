function addItem() {
    var dataRow = $('.dataRow').length;
    var index = $('.itemsId').length;
    var dataItems = [];
    $.each($('.items'), function () {
        dataItems += "<option data-index='"+(index+1)+"' data-unit='"+$(this).data('unit')+"' data-capacity='"+$(this).data('capacity')+"' data-weight='"+$(this).data('weight')+"' value='"+this.value+"'>"+$(this).data('name')+"</option>";
    });

    $('.dropItem').append(
        "<tr class='dataRow dataRow_"+(dataRow+1)+"'>"+
            "<td class='text-center' data-index='"+(index+1)+"'>" +(index+1)+ "</td>"+
            "<td>"+
                "<select class='form-control select itemsId' name='itemsId[]'>"+
                    "<option value='-' data-index='"+(index+1)+"'>- Select Item -</option>"+dataItems+
                "</select>"+
            "</td>"+
            "<td style='display:none'>"+
                "<input type='text' class='form-control text-right itemsWeight itemsWeight_"+(index+1)+"' readonly name='itemsWeight[]' data-index='"+(index+1)+"'>"+
                "<input type='text' class='form-control text-right itemsCapacity itemsCapacity_"+(index+1)+"' readonly name='itemsCapacity[]' data-index='"+(index+1)+"'>"+
            "</td>"+
            "<td>"+
                "<div class='input-group'>"+
                    "<input type='text' class='form-control text-right itemsQty itemsQty_"+(index+1)+"' name='itemsQty[]' data-index='"+(index+1)+"' value='0'>"+
                    // "<input type='text' class='form-control text-right itemsUnit itemsUnit_"+(index+1)+"' data-index='"+(index+1)+"' readonly>"+
                    "<div class='input-group-prepend'>"+
                    "<span class='input-group-text'>CT</span>"+
                    "</div>"+
                "</div>"+
            "</td>"+
            "<td>"+
                "<input type='date' class='form-control itemsExp ItemsExp_"+(index+1)+"' name='itemsExp[]' data-index='"+(index+1)+"'>"+
            "</td>"+
            "<td class='text-center'>"+
                "<button class='btn btn-danger btn-sm removeItem' type='button' value='"+(index+1)+"' >"+
                "<i class='fas fa-times'></i>"+
                "</button>"+
            "</td>"+
        "</tr>"
    );
}

$(document.body).on("change", ".itemsId", function () {
    var index = $(this).find(':selected').data('index');

    if ($(this).val() == '-') {
        $('.itemsWeight_' + index).val(0);
        $('.itemsUnit_' + index).val(' ');
        $('.itemsCapacity_' + index).val(0);
    } else {
        $('.itemsWeight_' + index).val($(this).find(':selected').data('weight'));
        $('.itemsUnit_' + index).val($(this).find(':selected').data('unit'));
        $('.itemsCapacity_' + index).val($(this).find(':selected').data('capacity'));
    }
});

$(document.body).on('click', '.removeItem', function () {
    $('.dataRow_'+this.value).remove();
});

function save() {
    // Swal.fire({
    //     title: 'Apakah Anda Yakin ?',
    //     text: "Anda akan menyimpan data Anda !",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Simpan Data'
    //     }).then((willSave) => {
    //     if (willSave) {
    //         var validation = 0;
    //         $('.validation').each(function () { 
    //             if ($(this).val() == '' || $(this).val() == null || $(this).val() == 0) {
    //                 validation++;
    //                 toastr.options = {
    //                     "progressBar" : true,
    //                     "positionClass" : "toast-bottom-right"
    //                 }
    //                 toastr.error("Data Harus Diisi !", "Warning");
    //             } else {
    //                 validation-1;
    //             }
    //         });
    //         if (validation != 0) {
    //             return false;
    //         }
            $.ajax({
                url: "/stock/stockIn",
                data: $(".form-data").serialize(),
                type: 'POST',
                processData: false,
                success: function(data) {
                    Swal.fire(
                    'Success!',
                    'Data berhasil disimpan',
                    'success'
                    )
                    // location.reload();
                    // window.open("{{ route('stockIn.index') }}");
                }
            });
        // }
    // })
}