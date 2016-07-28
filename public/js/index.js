$(document).ready(function () {
  var t = $('#table').DataTable({
	"info": false,
	"bSort": true,
	"language": {
	  "processing": "Przetwarzanie...",
	  "search": "Szukaj:",
	  "lengthMenu": "Pokaż _MENU_ pozycji",
	  "info": "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
	  "infoEmpty": "Pozycji 0 z 0 dostępnych",
	  "infoFiltered": "(filtrowanie spośród _MAX_ dostępnych pozycji)",
	  "infoPostFix": "",
	  "loadingRecords": "Wczytywanie...",
	  "zeroRecords": "Nie znaleziono pasujących pozycji",
	  "emptyTable": "Brak danych",
	  "paginate": {
		"first": "Pierwsza",
		"previous": "Poprzednia",
		"next": "Następna",
		"last": "Ostatnia"
	  },
	  "aria": {
		"sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
		"sortDescending": ": aktywuj, by posortować kolumnę malejąco"
	  }
	},
	"columnDefs": [{
		"searchable": false,
		"orderable": false,
		"targets": 0
	  }],
	"order": [[1, 'asc']]
  });

  t.on('order.dt search.dt', function () {
	t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
	  cell.innerHTML = i + 1 + ".";
	});
  }).draw();
});