function addItem() {
    var dataRow = $('.dataRow').length;
    var index = $('.itemsId').length;
    var dataItems = [];
    var dataRack = [];
    $.each($('.items'), function () {
        dataItems += "<option data-index='"+(index+1)+"' data-unit='"+$(this).data('unit')+"' data-capacity='"+$(this).data('capacity')+"' data-weight='"+$(this).data('weight')+"' value='"+this.value+"'>"+$(this).data('name')+"</option>";
    });
   
    $('.dropItem').append(
        "<tr class='dataRow dataRow_"+(dataRow+1)+"'>"+
            "<td class='text-center' data-index='"+(index+1)+"'>" +(index+1)+ "</td>"+
            "<td>"+
                "<select class='form-control select itemsId validation' name='itemsId[]' data-name='Item'>"+
                    "<option value='-' data-index='"+(index+1)+"'>- Select Item -</option>"+dataItems+
                "</select>"+
            "</td>"+
            "<td style='display:none'>"+
                "<input type='text' class='form-control text-right itemsWeight itemsWeight_"+(index+1)+"' readonly name='itemsWeight[]' data-index='"+(index+1)+"'>"+
            "</td>"+
            "<td>"+
                "<div class='input-group'>"+
                    "<input type='text' readonly class='form-control text-right itemsQty itemsQty_"+(index+1)+"' name='itemsQty[]' data-index='"+(index+1)+"' value='0'>"+
            //         // "<input type='text' class='form-control text-right itemsUnit itemsUnit_"+(index+1)+"' data-index='"+(index+1)+"' readonly>"+
                    "<div class='input-group-prepend'>"+
                    "<span class='input-group-text'>CT</span>"+
                    "</div>"+
                "</div>"+
            "</td>"+
            "<td class='dropSelect_"+(index+1)+"'>"+
          
                // "<input style='display:none' type='text' class='form-control text-right itemsCapacity itemsCapacity_"+(index+1)+"' readonly name='itemsCapacity[]' data-index='"+(index+1)+"'>"+
                // "<input type='text' class='form-control text-right itemsRack itemsRack_"+(index+1)+"' readonly name='itemsRack[]' data-index='"+(index+1)+"' value='0'>"+
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
    $('.select2').select2();
}
// mengganti item
$(document.body).on("change",".rackDtId",function(){
    var index = $(this).find(':selected').data('index');
  console.log($(this).find(':selected').data('index'));
  $('.itemsQty_' + index).val($(this).find(':selected').data('qty'));
});
function totalRack() {
    var totalRack = 0;
    $('.itemsRack').each(function () {
        totalRack += parseInt(this.value.replace(/,/g, ""));
    })
    $('#totalRack').val(parseInt(totalRack).toLocaleString('en-US'));
}

// Kebutuhan Rak berdasarkan qty item
$(document.body).on("keyup",".itemsQty", function () {
    var index = $(this).data('index');
    if (isNaN(parseInt($('.itemsCapacity_'+index).val()))) {
        var itemCap = 0; 
    } else {
        var itemCap = $('.itemsCapacity_'+index).val().replace(/,/g, ''),asANumber = +itemCap;
    }
    if (isNaN(parseInt(this.value))) {
        var itemQty = 0;
    } else {
        var itemQty = this.value.replace(/,/g, ''),asANumber = +itemQty;
    }
    if (itemQty%itemCap == 0) {
        var itemRack = itemQty/itemCap;
    } else {
        var itemRack = itemQty/itemCap +1;
    }
    $('.itemsRack_'+index).val(parseInt(itemRack).toLocaleString('en-US'));

    totalRack();
});

// Mengganti Item
$(document.body).on("change", ".itemsId", function () {
    var index = $(this).find(':selected').data('index');
    var values = $(this).find(':selected').val();
    if ($(this).val() == '-') {
        $('.itemsWeight_' + index).val(0);
        $('.itemsUnit_' + index).val(' ');
        $('.itemsQty_' + index).val(' ');
        $('.itemsCapacity_' + index).val(0);
        $('.itemsRack_' + index).val(0);
    } else {
        if (isNaN(parseInt($(this).find(':selected').data('capacity')))) {
            var itemCap = 0;
        } else {
            var itemCap = $(this).find(':selected').data('capacity');
        }
        if (isNaN(parseInt($('.itemsQty_' + index).val()))) {
            var itemQty = 0;
        } else {
            var itemQty = $('.itemsQty_' + index).val().replace(/,/g, ''), asANumber = +itemQty;
        }
        if (itemQty%itemCap == 0) {
            var itemRack = itemQty/itemCap;
        } else {
            var itemRack = itemQty/itemCap +1;
        }
        $('.itemsWeight_' + index).val($(this).find(':selected').data('weight'));
        $('.itemsUnit_' + index).val($(this).find(':selected').data('unit'));
        $('.itemsCapacity_' + index).val(parseInt(itemCap).toLocaleString('en-US'));
        $('.itemsRack_' + index).val(parseInt(itemRack).toLocaleString('en-US'));
        // $('.itemsCapacity_' + index).val($(this).find(':selected').data('capacity'));
    }

    totalRack();
    // console.log(index);
    // console.log(values);
    var origin = $('.origin').find(':selected').val();
    $.ajax({
        url: "/stock/stockOut/stockRackCheck",
        data:  {'id':values,'origin':origin},
        type: 'GET',
        // processData: false,
        success: function(data) {
        //     Swal.fire(
        //     'Success!',
        //     'Data berhasil disimpan',
        //     'success'
        //     )
            // location.reload();
            // window.location = route+'?'+$(".form-data").serialize();
            var dataRack = '';
            // dataRack+="<option value='-'>- pilih -</option>";
            $.each(data.data, function (i,val) {
                dataRack += "<option data-index='"+(index)+"' data-qty='"+val.item_qty+"'  value='"+val.rack_dt[0].id+"'>"+val.rack_dt[0].racks.name+'-'+val.rack_dt[0].number+"</option>";
            });
            console.log(dataRack);
            $('.dropSelect_'+index).html("<select class='form-control select-2 rackDtId validation'  name='rackDtId"+(index)+"[]' >"+
            "<option value='-' selected data-index='"+(index)+"' data-qty='0'>- pilih -</option>"+
                dataRack+
            "</select>");
        }
    });
});

// Menghapus Baris Item
$(document.body).on('click', '.removeItem', function () {
    $('.dataRow_'+this.value).remove();

    totalRack();
});

function chooseRack() {
    Swal.fire({
        title: 'Apakah Anda Yakin ?',
        text: "Anda akan pergi ke halaman selanjutnya !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjutkan'
    }).then((next) => {
        if (next) {
            var validation = 0;
            $('.validation').each(function () { 
                if ($(this).val() == '' || $(this).val() == '-' || $(this).val() == null || $(this).val() == 0) {
                    validation++;
                    toastr.options = {
                        "progressBar" : true,
                        "positionClass" : "toast-bottom-right"
                    }
                    toastr.error($(this).data('name')+" Harus Diisi !", "Warning");
                } else {
                    validation-1;
                }
            });
            if (validation != 0) {
                return false;
            }
            $.ajax({
                url: "/stock/stockIn/formManual",
                data: $(".form-data").serialize(),
                type: 'POST',
                processData: false,
                success: function(data) {
                //     Swal.fire(
                //     'Success!',
                //     'Data berhasil disimpan',
                //     'success'
                //     )
                    // location.reload();
                    window.location = route+'?'+$(".form-data").serialize();
                }
            });
        }
    })
}




function generateAlgen() {
    $.ajax({
        url: "/stock/stockIn/generateAlgen?&generate=generate",
        data: $(".form-data").serialize(),
        type: 'POST',
        processData: false,
        success: function(data) {
            $('.dropHere').empty();
            var main = [];
                
            $.each(data.data, function (index,value) {
                var mainDetail = [];
                $.each(value.rack_number, function (index1,value1) {
                    mainDetail[index1] = "<td><input readonly value='"+value1.id+"' class='form-control'  name='rackDtStore"+index+"[]'></td>";

                });
                main[index] = 
                    "<tr style='width: 100%'>"+
                        "<td class='text-center'>"+(index+1)+"</td>"+
                        "<td>"+
                            "<input readonly type='hidden' value='"+value.item.total_weight+"' name='itemsWeightStore"+index+"[]' class='form-control'>"+
                            "<input readonly type='hidden' value='"+value.item.rack_capacity+"' name='itemsCapacityStore"+index+"[]' class='form-control'>"+
                            "<input readonly type='hidden' value='"+value.item.id+"' name='itemsIdStore"+index+"[]' class='form-control'>"+
                            "<input readonly type='hidden' value='"+data.t[index][0]+"' name='itemsQtyStore"+index+"[]' class='form-control'>"+
                            "<input readonly value='"+value.item.name+"' class='form-control'>"+
                        "</td>"+
                            mainDetail+
                    "</tr>";
            });
            $('.dropHere').append(main);
        }
    });
}

function algen() {
    $.ajax({
        url: "/stock/stockIn/algen",
        data: $(".form-data").serialize(),
        type: 'POST',
        processData: false,
        success: function(data) {
            // Swal.fire(
            // 'Success!',
            // 'Data berhasil disimpan',
            // 'success'
            // )
            // location.reload();
            // window.open("{{ route('stockIn.index') }}");
        }
    });
}

// Save Data
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
                url: "/stock/stockOut",
                data: $(".form-data").serialize(),
                type: 'POST',
                processData: false,
                success: function(data) {
                    // Swal.fire(
                    // 'Success!',
                    // 'Data berhasil disimpan',
                    // 'success'
                    // )
                    // location.reload();
                    // window.reload("{{ route('stockIn.index') }}");
                }
            });
        // }
    // })
}

// Save Data Auto
function save2() {
    Swal.fire({
        title: 'Apakah Anda Yakin ?',
        text: "Anda akan menyimpan data Anda !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Simpan Data'
        }).then((willSave) => {
        if (willSave) {
            var validation = 0;
            $('.validation').each(function () { 
                if ($(this).val() == '' || $(this).val() == null || $(this).val() == 0) {
                    validation++;
                    toastr.options = {
                        "progressBar" : true,
                        "positionClass" : "toast-bottom-right"
                    }
                    toastr.error("Data Harus Diisi !", "Warning");
                } else {
                    validation-1;
                }
            });
            if (validation != 0) {
                return false;
            }
            $.ajax({
                url: "/stock/stockIn/store2",
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
                    window.reload("{{ route('stockIn.index') }}");
                }
            });
        }
    })
}