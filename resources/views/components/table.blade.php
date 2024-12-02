
<div class="px-4 mx-n4">
    <div class="table-responsive">
        <table id="{{ $id }}" data-id="{{ $id }}" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
            <thead>
                <tr>
                    @foreach ($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td>{!! $cell !!}</td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($headers) }}" class="text-center">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function initializeTables() {
        const tables = document.querySelectorAll('table[data-id]');
        tables.forEach(function (table) {
            const id = table.getAttribute('id');
            if (id) {
                new DataTable(`#${id}`);
            }
        });
    }
    document.addEventListener("DOMContentLoaded", function () {
        initializeTables();
    });
</script>

