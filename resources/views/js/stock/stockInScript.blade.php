<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    function addItem() {
        var dataRow = $('.dataRow').length;
        var index = $('.itemsId').length;
        var dataItems = [];
        $.each($('.items'), function () {
            dataItems += "<option data-index='"+(index+1)+"' data-unit='"+$(this).data('unit')+"' value='"+this.value+"'>"+$(this).data('name')+"</option>";
        });

        $('.dropItem').append(
            "<tr class='dataRow dataRow_"+(dataRow+1)+"'>"+
                "<td class='text-center' data-index='"+(index+1)+"'>" +(index+1)+ "</td>"+
                "<td>"+
                    "<select class='form-control select itemsId' name='itemsId[]'>"+
                        "<option value='-' data-index='"+(index+1)+"'>- Select Item -</option>"+dataItems+
                    "</select>"+
                "</td>"+
                "<td>"+
                    "<div class='input-group'>"+
                        "<input type='text' class='form-control text-right itemsQty itemsQty_"+(index+1)+"' name='itemsQty[]' data-index='"+(index+1)+"' value='0'>"+
                        "<div class='input-group-prepend'>"+
                        "<span class='input-group-text'>CT</span>"+
                        "</div>"+
                    "</div>"+
                "</td>"+
                "<td>"+
                    "<input type='date' class='form-control itemsExp ItemsExp_"+(index+1)+"' name='itemsExp[]' data-index='"+(index+1)+"'>"+
                "</td>"+
                "<td class='text-center'>"+
                    "<button class='btn btn-danger btn-sm removeItem' value='"+(index+1)+"' >"+
                    "<i class='fas fa-times'></i>"+
                    "</button>"+
                "</td>"+
            "</tr>"
        );
    }

    $(document.body).on('click', '.removeItem', function () {
        $('.dataRow_'+this.value).remove();
    });

    function save() {
        $.ajax({
            url: "{{ route('stockIn.store') }}",
            data: $(".form-data").serialize(),
            type: 'POST',
            processData: false,
            success: function(data) {
                // window.open("{{ route('stockIn.index') }}");
                location.reload();
            }
        });
    }
</script>
