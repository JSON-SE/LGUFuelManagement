<div class="table-responsive mt-2">
    <table class="table table-striped w-100" id="website-review-table">
        <thead class="text-white bg-secondary">
            <tr>
                <th> # </th>
                <th>Rating</th>
                <th>Title Review</th>
                <th>Review</th>
                <th>Name</th>
                <th>City</th> 
                <th>Province</th>
                <th>Review Date</th>
            </tr>
        </thead>
        <tbody>

        </tbody>

    </table>
</div>
@push('js')

    <script>
        jQuery(document).ready(function () {
            $('#website-review-table').DataTable({
                processing: true,
                serverSide: true,
                ordering : false,
                ajax: {
                    method : "POST",
                    url: '/admin/review-of-product',
                    data:{
                        'product_id' : {{$productID}} 
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'rating_point', name: 'rating_point' },
                    { data: 'title_review', name: 'title_review' },
                    { data: 'review', name: 'review' },
                    { data: 'name', name: 'name' },
                    { data: 'city', name: 'city' },
                    { data: 'province', name: 'province' },
                    { data: 'created_at', name: 'created_at' },
                ]
            })
        });
    </script>
    @endpush