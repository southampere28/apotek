document.addEventListener('DOMContentLoaded', function () {
    if (!window.simpleDatatables) {
        return;
    }

    const tables = document.querySelectorAll('.js-datatable');

    tables.forEach(function (table) {
        const perPage = Number(table.dataset.perPage || 10);
        const searchable = table.dataset.searchable !== 'false';
        const sortable = table.dataset.sortable !== 'false';

        new simpleDatatables.DataTable(table, {
            perPage: perPage,
            perPageSelect: [5, 10, 25, 50, 100],
            searchable: searchable,
            sortable: sortable,
            fixedHeight: false,

            paging: true,
            truncatePager: true,
            pagerDelta: 1,
            ellipsisText: '...',

            firstLast: true,
            nextPrev: true,
            firstText: '«',
            lastText: '»',
            prevText: '‹',
            nextText: '›',

            labels: {
                perPage: 'data per halaman',
                noRows: 'Tidak ada data',
                info: 'Menampilkan {start} sampai {end} dari {rows} data',
            },
        });
    });
});