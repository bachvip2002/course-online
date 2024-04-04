@if ($paginator->hasPages())
    <div class="row">
        <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
            <div class="dataTables_length" id="kt_customers_table_length"><label><select name="kt_customers_table_length"
                        aria-controls="kt_customers_table" class="form-select form-select-sm form-select-solid">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select></label></div>
        </div>
        <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
            <div class="paging_simple_numbers" id="">
                <ul class="pagination">
                    <li class="paginate_button page-item previous disabled" id="kt_customers_table_previous"><a
                            href="#" aria-controls="kt_customers_table" data-dt-idx="0" tabindex="0"
                            class="page-link"><i class="previous"></i></a></li>
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="disabled" aria-disabled="true"><a>{{ $element }}</a></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="paginate_button page-item active"><a href="{{ $url }}"
                                            aria-controls="kt_customers_table" data-dt-idx="{{ $page }}"
                                            tabindex="0" class="page-link">{{ $page }}</a></li>
                                @else
                                    <li class="paginate_button page-item "><a href="{{ $url }}"
                                            aria-controls="kt_customers_table" data-dt-idx="{{ $page }}"
                                            tabindex="0" class="page-link">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- <li class="paginate_button page-item "><a href="#" aria-controls="kt_customers_table"
                            data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="kt_customers_table"
                            data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="kt_customers_table"
                            data-dt-idx="4" tabindex="0" class="page-link">4</a></li> --}}
                    <li class="paginate_button page-item next" id="kt_customers_table_next"><a href="#"
                            aria-controls="kt_customers_table" data-dt-idx="5" tabindex="0" class="page-link"><i
                                class="next"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
@endif
