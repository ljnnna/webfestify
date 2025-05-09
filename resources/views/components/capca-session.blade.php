
<div class="mt-2 w-full flex flex-col justify-center items-center px-4 min-h-[100px]">
              <div class="inline-block transform scale-[0.75] sm:scale-100 origin-top">
               {!! NoCaptcha::display() !!}
              </div>

              <!-- Error Message Centered Below CAPTCHA -->
               @if ($errors->has('g-recaptcha-response'))
                  <div class="w-full text-center mt-2">
                      <span class="text-red-500 text-sm">
                          {{ $errors->first('g-recaptcha-response') }}
                      </span>
                  </div>
               @endif
          </div>