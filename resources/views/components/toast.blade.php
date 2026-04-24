{{-- Composant Toast Universel --}}
@if(session('toast') || session('success'))
    <div id="universalToast"
         class="fixed top-5 right-5 z-50 transform transition-all duration-500 ease-in-out translate-x-full opacity-0">
        <div class="min-w-[300px] max-w-md rounded-lg shadow-lg overflow-hidden">

            @php
                $type = session('toast_type', 'success');
                $message = session('toast') ?? session('success');

                $bgColor = match($type) {
                    'success' => 'bg-green-500',
                    'error' => 'bg-red-500',
                    'warning' => 'bg-yellow-500',
                    'info' => 'bg-blue-500',
                    default => 'bg-green-500'
                };

                $icon = match($type) {
                    'success' => '✓',
                    'error' => '✗',
                    'warning' => '⚠',
                    'info' => 'ℹ',
                    default => '✓'
                };
            @endphp

            <div class="{{ $bgColor }} px-4 py-3 text-white">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <span class="text-xl font-bold">{{ $icon }}</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium">{{ $message }}</p>
                    </div>
                    <button onclick="hideToast()" class="flex-shrink-0 text-white hover:text-gray-200">
                        ✕
                    </button>
                </div>
            </div>

            <div class="h-1 bg-white/30">
                <div id="toastProgress" class="h-full bg-white transition-all duration-[5000ms] linear" style="width: 100%"></div>
            </div>
        </div>
    </div>

    <script>
        function showToast() {
            const toast = document.getElementById('universalToast');
            if (toast) {
                setTimeout(() => {
                    toast.classList.remove('translate-x-full', 'opacity-0');
                    toast.classList.add('translate-x-0', 'opacity-100');
                }, 100);

                const progressBar = document.getElementById('toastProgress');
                if (progressBar) {
                    setTimeout(() => {
                        progressBar.style.width = '0%';
                    }, 100);
                }

                setTimeout(() => {
                    hideToast();
                }, 5000);
            }
        }

        function hideToast() {
            const toast = document.getElementById('universalToast');
            if (toast) {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-full', 'opacity-0');

                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 500);
            }
        }

        showToast();
    </script>
@endif
