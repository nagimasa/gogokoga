<footer class="bg-white mb-5 transpotation">
    <section class="px-2 py-4 border-gray-300 border-b border-t  sm:max-w-3xl m-auto">
        <a href="{{ Route('user.contact.index')}}" ><div class="w-full publish-btn text-center text-white py-4 font-bold mb-4">掲載のお問い合わせ</div></a>
        <ul>
            <li class="text-xs pb-2"><a href="{{ Route('user.aboutus')}}">当サイトについて</a></li>
            <li class="text-xs pb-2"><a href="{{ Route('user.contact.index')}}">掲載のお問い合わせ</a></li>
            <li class="text-xs pb-2"><a href="{{ Route('user.rule')}}">掲載規約</a></li>
        </ul>
    </section>
    <section class="copyright py-7">
        <p class="text-center text-white text-xs">copyright Gogo古賀</p>
    </section>
</footer>
</body>



<script src="{{ asset('js/menu.js') }}"></script>
</html>