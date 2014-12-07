@extends('admin/layouts.master')
@section('content')
	@include('admin.layouts.header')
@section('script')
@parent
<script>
  $(function () {
    $('td, th', '#sortable').each(function () {
        var cell = $(this);
        cell.width(cell.width());
    });

    $('#sortable tbody').sortable(
    	{
    		stop: function(event, ui)
    		{
    			actualizarOrdenProyectos();
    		}
    	}).disableSelection();
});
  </script>
@stop
	<div ng-view class="container"></div>
@stop