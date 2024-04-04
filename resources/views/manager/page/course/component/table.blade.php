   <div class="kt_user_table_wrapper">
       <div class="table-responsive">
           <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_user_table">
               <thead>
                   <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                       <th class="w-10px pe-2">
                           <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                               <input class="form-check-input" type="checkbox" data-kt-check="true"
                                   data-kt-check-target="#kt_user_table .form-check-input" value="1" />
                           </div>
                       </th>
                       <th class="min-w-50px">ID</th>
                       <th class="min-w-200px">Mã</th>
                       <th class="min-w-200px">Tên</th>
                       <th class="min-w-200px">Gía</th>
                       <th class="min-w-200px">trạng thái</th>
                       <th class="text-end">Hành động</th>
                   </tr>
               </thead>
               <tbody class="fw-semibold text-gray-600">
                   @forelse ($courses as $course)
                       <tr class="is-record-{{ $course->id }}">
                           <td>
                               <div class="form-check form-check-sm form-check-custom form-check-solid">
                                   <input class="form-check-input" type="checkbox" value="1" />
                               </div>
                           </td>
                           <td>
                               <span class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $course->id }}</span>
                           </td>
                           <td>
                               <span class="text-gray-800 text-hover-primary fs-5">{{ $course->code }}</span>
                           </td>
                           <td>
                               <div class="d-flex align-items-center">
                                   <div class="symbol symbol-50px overflow-hidden me-3">
                                       <a href="{{ asset('upload/' . $course->image_path) }}" target="_blank">
                                           <div class="symbol-label">
                                               <img src="{{ asset('upload/' . $course->image_path) }}"
                                                   alt="Francis Mitcham" class="w-100">
                                           </div>
                                       </a>
                                   </div>
                                   <div class="ms-5">
                                       <!--begin::Title-->
                                       <span class="fw-bold"
                                           data-kt-ecommerce-product-filter="name">{{ $course->name }}</span>
                                       <!--end::Title-->
                                   </div>
                               </div>
                           </td>
                           <td>
                               <span class="text-gray-800 text-hover-primary fs-5">{{ $course->price }}</span>
                           </td>
                           <td>
                               <span class="text-gray-800 text-hover-primary fs-5">{{ $course->status }}</span>
                           </td>
                           <td class="text-end">
                               <a class="btn btn-sm btn-warning"
                                   href="{{ route('manager.course.edit-page', ['course_id' => $course->id]) }}">Sửa</a>
                               <button class="btn btn-sm btn-danger ajax-btn-delete"
                                   data-url_delete_course="{{ route('manager.course.delete', ['course_id' => $course->id]) }}">Xóa</button>
                               <a class="btn btn-sm btn-info"
                                   href="{{ route('manager.course.edit-page', ['course_id' => $course->id]) }}">
                                   Chi tiết
                               </a>
                               <a class="btn btn-sm btn-info"
                                   href="{{ route('manager.course.chapter.edit-page', ['course_id' => $course->id]) }}">
                                   Danh sách chương học
                               </a>
                           </td>
                       </tr>
                   @empty
                   @endforelse
               </tbody>
           </table>
       </div>
   </div>
