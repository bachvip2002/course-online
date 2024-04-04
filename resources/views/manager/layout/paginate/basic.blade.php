{{ $paginator->appends(request()->except('page'))->links('manager.layout.paginate.template-basic') }}
