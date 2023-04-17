<div class="pt-2 justify-content-center">
    <div class="table-responsive mt-2">
        <table class="table colourtable" id="productColorTable">
            <thead class="text-white bg-secondary">
                <tr>
                    <th scope="col py-2">
                        #
                    </th>
                    <th scope="col py-2">
                        Name
                    </th>
                    <th scope="col py-2">
                        Type
                    </th>
                    <th scope="col py-2">
                        Show
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($filterPorducts as $filterPorduct)
                <tr class="colour-row ui-state-default align-middle" data-id="{{$filterPorduct->id}}">
                    <td>
                        {{$loop->index+1}}
                    </td>
                    <td>
                        {{$filterPorduct->name}}
                    </td>
                    <td>
                        @if($filterPorduct->type == 1)
                        Rooms
                        @else
                        Features
                        @endif
                    </td>
                    <td>
                        <input name="product_filter_value[]" type="checkbox" value="{{$filterPorduct->id}}" {{$filterPorduct->isProductFilter($filterPorduct->id,$productID) == true ? 'checked' : ''}}/>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-4 pb-4 text-end tab-btn-position">
            <button type="submit" class="btn btn-primary info-submit productFilter" >
                Update
            </button>
        </div>
    </div>
</div>
<script type="text/javascript">

   $(document).on('submit', "#filterForm", function(e) {
        event.preventDefault();
       let $this = $(this);
        let formData = $this.serialize();
         $("#loader").show();
        axios.post(`/admin/product/filter/assign`,formData)
        .then((response) =>{
            $("#loader").hide();
            if(response.data.status == true){
                toastr.success(response.data.message);
            }
        }).catch(e =>{
            $("#loader").hide();
            toastr.error(response.data.message);
        })
    });
</script>
