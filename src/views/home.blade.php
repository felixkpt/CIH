<div class="">
    <form action="{{route('ministries')}}" method="post">
        @csrf
        <div class="w-full mb-2">
            <input type="text" name="name" id="name" placeholder="Enter your name" class="w-full rounded p-1">
        </div>
        <div class="w-full mb-2">
            <input type="email" name="email" id="email" placeholder="Enter your email" class="w-full rounded p-1">
        </div>
        <div class="w-full mb-2">
            <textarea name="message" id="message" placeholder="Enter your message" class="w-full rounded p-1"></textarea>
        </div>
        <button type="submit">Send</button>
    </form>
</div>