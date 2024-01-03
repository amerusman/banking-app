<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Statement of Account') }}
        </h2>
    </header>
    <div class="mb-5 overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">DATETIME</th>
                <th scope="col">AMOUNT</th>
                <th scope="col">TYPE</th>
                <th scope="col">DETAILS</th>
                <th scope="col">BALANCE</th>

            </tr>
            </thead>
            <tbody>
            <?php $num=1;?>
            @foreach ($statement as $row)
                <tr>
                    <th scope="row">{{$num}}</th>
                    <td>{{$row->created_at}}</td>
                    <td>{{$row->amount}}</td>
                    <td>{{$row->type}}</td>
                    @if(!empty($row->transfer) and $row->type == 'credit')
                        <td>Transfer To</td>
                    @elseif($row->type == 'credit' and empty($row->transfer))
                        <td>Deposit</td>
                    @else
                    <td>WithDraw</td>
                    @endif
                    <td>{{$row->balance_after}}</td>
                        <?php $num++;?>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $statement->links() }}
    </div>

</section>
