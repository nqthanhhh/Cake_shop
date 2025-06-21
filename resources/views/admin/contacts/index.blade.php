@extends('admin.layouts')

@section('title', 'Tin nhắn của khách hàng')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Tin nhắn từ khách hàng</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Thành công!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden flex" style="height: calc(100vh - 15rem);">
        <!-- Left column: Message List -->
        <div class="w-1.5/5 border-r border-gray-200 overflow-y-auto" id="contact-list">
            @forelse ($contacts as $contact)
                <div class="contact-item p-4 border-b border-gray-200 cursor-pointer hover:bg-gray-50"
                     data-name="{{ $contact->name }}"
                     data-email="{{ $contact->email }}"
                     data-phone="{{ $contact->phone ?? 'N/A' }}"
                     data-message="{{ $contact->message }}"
                     data-date="{{ $contact->created_at->format('d/m/Y H:i') }}">
                    <p class="font-semibold text-gray-900">{{ $contact->name }}</p>
                    <p class="text-sm text-gray-600 truncate">{{ Str::limit($contact->message, 35) }}</p>
                </div>
            @empty
                <div class="p-4 text-center text-gray-500">
                    <p>Không có tin nhắn nào.</p>
                </div>
            @endforelse
        </div>

        <!-- Right column: Message Detail -->
        <div class="w-4/5 p-6 flex flex-col">
            <div id="message-placeholder" class="flex-grow flex items-center justify-center text-center text-gray-500">
                <div>
                    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <p class="mt-2 font-semibold">Chọn một tin nhắn để xem chi tiết</p>
                </div>
            </div>
            <div id="message-content" class="hidden flex-grow flex-col">
                <div class="pb-4 mb-4 border-b">
                    <h2 id="detail-name" class="text-2xl font-bold text-gray-800"></h2>
                    <div class="mt-2 space-y-1 text-sm text-gray-600">
                        <p><strong>Email:</strong> <span id="detail-email"></span></p>
                        <p><strong>SĐT:</strong> <span id="detail-phone"></span></p>
                        <p><strong>Ngày gửi:</strong> <span id="detail-date"></span></p>
                    </div>
                </div>
                <div class="flex-grow overflow-y-auto">
                    <p id="detail-message" class="text-gray-800 whitespace-pre-wrap"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactList = document.getElementById('contact-list');
    const placeholder = document.getElementById('message-placeholder');
    const content = document.getElementById('message-content');

    const detailName = document.getElementById('detail-name');
    const detailEmail = document.getElementById('detail-email');
    const detailPhone = document.getElementById('detail-phone');
    const detailMessage = document.getElementById('detail-message');
    const detailDate = document.getElementById('detail-date');

    let activeItem = null;

    if (contactList) {
        contactList.addEventListener('click', function(e) {
            const item = e.target.closest('.contact-item');
            if (!item) return;

            if (activeItem) {
                activeItem.classList.remove('bg-blue-50');
            }
            item.classList.add('bg-blue-50');
            activeItem = item;

            placeholder.classList.add('hidden');
            content.classList.remove('hidden');
            content.classList.add('flex');

            detailName.textContent = item.dataset.name;
            detailEmail.textContent = item.dataset.email;
            detailPhone.textContent = item.dataset.phone;
            detailMessage.textContent = item.dataset.message;
            detailDate.textContent = item.dataset.date;
        });
    }
});
</script>
@endsection
