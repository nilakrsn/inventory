<x-app-layout>
   <div class="flex flex-row">
        <aside class="flex flex-col border-r border-sky-100 w-1/6 h-screen">
            <div class="flex items-center border-b border-sky-100 px-6 py-3">
                <img src="air.png" class="w-12 mr-2" alt="Logo">
                <span class="ml-2 font-semibold text-xl text-sky-900">Inventory</span>
            </div>
            <nav class="flex flex-col">
                <div class="px-6 pt-6 pb-2 text-sky-400">Main Menu</div>
                <div class="flex flex-col px-5 text-sky-800">
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-sky-800 hover:text-white rounded-sm cursor-pointer group">
                        <ion-icon name="home-outline" class="text-sky-800 group-hover:text-white"></ion-icon>
                        <span class="ml-2">Dashboard</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-sky-800 hover:text-white rounded-sm cursor-pointer group">
                        <ion-icon name="cube-outline" class="text-sky-800 group-hover:text-white"></ion-icon>
                        <span class="ml-2">Products</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-sky-800 hover:text-white rounded-sm cursor-pointer group">
                        <ion-icon name="arrow-down-circle-outline" class="text-sky-800 group-hover:text-white"></ion-icon>
                        <span class="ml-2">Stock In</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-sky-800 hover:text-white rounded-sm cursor-pointer group">
                        <ion-icon name="arrow-up-circle-outline" class="text-sky-800 group-hover:text-white"></ion-icon>
                        <span class="ml-2">Stock Out</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-sky-800 hover:text-white rounded-sm cursor-pointer group">
                        <ion-icon name="cash-outline" class="text-sky-800 group-hover:text-white"></ion-icon>
                        <span class="ml-2">Income</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-sky-800 hover:text-white rounded-sm cursor-pointer group">
                        <ion-icon name="card-outline" class="text-sky-800 group-hover:text-white"></ion-icon>
                        <span class="ml-2">Expand</span>
                    </a>
                </div>
                <div class="px-6 pt-4 pb-2 text-sky-400">Other Menu</div>
                <div class="flex flex-col px-5 text-sky-800">
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-sky-800 hover:text-white rounded-sm cursor-pointer group">
                        <ion-icon name="log-out-outline" class="text-sky-800 group-hover:text-white"></ion-icon>
                        <span class="ml-2">Logout</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-sky-800 hover:text-white rounded-sm cursor-pointer group">
                        <ion-icon name="document-text-outline" class="text-sky-800 group-hover:text-white"></ion-icon>
                        <span class="ml-2">Report</span>
                    </a>
                </div>
            </nav>
        </aside>
    </div>
</x-app-layout>
