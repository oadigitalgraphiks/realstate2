<div class="modal-body">
  <div class="text-center">
      <span class="avatar avatar-xxl mb-3">
          <img src="{{ uploaded_asset($seller->user->avatar_original) }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
      </span>
      <h1 class="h5 mb-1">{{ $seller->user->name }}</h1>
      <p class="text-sm text-muted">{{ $seller->user->shop->name }}</p>

      <div class="pad-ver btn-groups">
          <a href="{{ $seller->user->shop->facebook }}" class="btn btn-icon demo-pli-facebook icon-lg add-tooltip" data-original-title="Facebook" data-container="body"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"> <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/> </svg></a>
          <a href="{{ $seller->user->shop->twitter }}" class="btn btn-icon demo-pli-twitter icon-lg add-tooltip" data-original-title="Twitter" data-container="body"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16"> <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/> </svg></a>
          <a href="{{ $seller->user->shop->google }}" class="btn btn-icon demo-pli-google-plus icon-lg add-tooltip" data-original-title="Google+" data-container="body"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16"> <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/> </svg></a>
      </div>
  </div>

  <hr>

  <!-- Profile Details -->
  <h6 class="mb-4">{{translate('About')}} {{ $seller->user->name }}</h6>
  <p><i class="demo-pli-map-marker-2 icon-lg icon-fw mr-1"></i>{{ $seller->user->shop->address }}</p>
  <p><a href="{{ route('shop.visit', $seller->user->shop->slug) }}" class="btn-link"><i class="demo-pli-internet icon-lg icon-fw mr-1"></i>{{ $seller->user->shop->name }}</a></p>
  <p><i class="demo-pli-old-telephone icon-lg icon-fw mr-1"></i>{{ $seller->user->phone }}</p>

  <h6 class="mb-4">{{translate('Payout Info')}}</h6>
  <p>{{translate('Bank Name')}} : {{ $seller->bank_name }}</p>
  <p>{{translate('Bank Acc Name')}} : {{ $seller->bank_acc_name }}</p>
  <p>{{translate('Bank Acc Number')}} : {{ $seller->bank_acc_no }}</p>
  <p>{{translate('Bank Routing Number')}} : {{ $seller->bank_routing_no }}</p>

  <br>

  <div class="table-responsive">
      <table class="table table-striped mar-no">
          <tbody>
          <tr>
              <td>{{ translate('Total Products') }}</td>
              <td>{{ App\Models\Product::where('user_id', $seller->user->id)->get()->count() }}</td>
          </tr>
          <tr>
              <td>{{ translate('Total Orders') }}</td>
              <td>{{ App\Models\OrderDetail::where('seller_id', $seller->user->id)->get()->count() }}</td>
          </tr>
          <tr>
              <td>{{ translate('Total Sold Amount') }}</td>
              @php
                  $orderDetails = \App\Models\OrderDetail::where('seller_id', $seller->user->id)->get();
                  $total = 0;
                  foreach ($orderDetails as $key => $orderDetail) {
                      if($orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                          $total += $orderDetail->price;
                      }
                  }
              @endphp
              <td>{{ single_price($total) }}</td>
          </tr>
          <tr>
              <td>{{ translate('Wallet Balance') }}</td>
              <td>{{ single_price($seller->user->balance) }}</td>
          </tr>
          </tbody>
      </table>
  </div>
</div>


