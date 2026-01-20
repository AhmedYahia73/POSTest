<x-filament-panels::page>
    <div class="space-y-6">
        {{-- قسم اختيار الفرع --}}
 {{-- قسم اختيار الفرع --}}
        <x-filament::section>
            <x-slot name="heading">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Select Branch</span>
                    
                    @if($branch_id)
                        <x-filament::button 
                            color="gray" 
                            icon="heroicon-m-printer" 
                            onclick="window.print()"
                            size="sm"
                            outlined>
                            Print Menu
                        </x-filament::button>
                    @endif
                </div>
            </x-slot>
            
            <div style="display: grid; grid-template-columns: 1fr auto; gap: 2rem; align-items: start;">
                <form wire:submit.prevent="">
                    {{ $this->form }}
                </form>
                
                @if($branch_id)
                    @php
                        $selected_branch = \App\Models\Branch::find($branch_id);
                        $qr_url = url('admin/Branch/' . $branch_id);
                    @endphp
                    
                    <div style="text-align: center;">
                        <div style="background: white; padding: 1rem; border-radius: 0.75rem; border: 2px solid rgb(229, 231, 235); box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            {!! QrCode::size(150)->generate($qr_url) !!}
                        </div>
                        <p style="margin-top: 0.5rem; font-size: 0.75rem; color: rgb(107, 114, 128); font-weight: 600;">
                            Scan Qr
                        </p>
                    </div>
                @endif
            </div>
        </x-filament::section>

        @if($branch_id)
            @php
                $branche_name = \App\Models\Branch::find($branch_id)?->name;
                $categories = \App\Models\Category::with(['products' => function($query) use($branch_id) {
                    $query->where('branch_id', $branch_id);
                }])->get()->filter(fn($cat) => $cat->products->count() > 0);
            @endphp

            {{-- هيدر المنيو --}}
            <x-filament::section>
                <x-slot name="heading">
                    قائمة طعام: {{ $branche_name }}
                </x-slot>
                <x-slot name="description">
                    عدد الأقسام: {{ $categories->count() }}
                </x-slot>
            </x-filament::section>

            {{-- عرض الأقسام والمنتجات --}}
            @forelse($categories as $category)
                <x-filament::section>
                    <x-slot name="heading">
                        <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                            <span>{{ $category->name }}</span>
                            <x-filament::badge color="primary">
                                {{ $category->products->count() }} منتج
                            </x-filament::badge>
                        </div>
                    </x-slot>

                    {{-- شبكة المنتجات --}}
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
                        @foreach($category->products as $product)
                            <div style="border: 1px solid rgb(229, 231, 235); border-radius: 0.75rem; overflow: hidden; background: white; transition: all 0.3s;">
                                {{-- صورة المنتج --}}
                                <div style="position: relative; height: 200px; background: rgb(249, 250, 251);">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: rgb(209, 213, 219);">
                                            <svg style="width: 4rem; height: 4rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    {{-- السعر --}}
                                    <div style="position: absolute; top: 0.75rem; left: 0.75rem;">
                                        <div style="background: white; border-radius: 0.5rem; padding: 0.5rem 0.75rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                                            <span style="font-size: 1.25rem; font-weight: 700; color: rgb(59, 130, 246);">{{ number_format($product->price, 0) }}</span>
                                            <span style="font-size: 0.75rem; color: rgb(107, 114, 128);"> ج.م</span>
                                        </div>
                                    </div>

                                    {{-- حالة التوفر --}}
                                    <div style="position: absolute; top: 0.75rem; right: 0.75rem;">
                                        <x-filament::badge color="success">
                                            متاح
                                        </x-filament::badge>
                                    </div>
                                </div>

                                {{-- تفاصيل المنتج --}}
                                <div style="padding: 1.25rem;">
                                    <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.5rem; color: rgb(17, 24, 39);">
                                        {{ $product->name }}
                                    </h3>
                                    
                                    <p style="font-size: 0.875rem; color: rgb(107, 114, 128); margin-bottom: 1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $product->description ?? 'منتج مميز ومحضر بعناية' }}
                                    </p>
                                    
                                    {{-- زر الطلب --}}
                                    <x-filament::button 
                                        color="primary" 
                                        style="width: 100%;">
                                        اطلب الآن
                                    </x-filament::button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-filament::section>
            @empty
                <x-filament::section>
                    <div style="text-align: center; padding: 3rem 0;">
                        <p style="color: rgb(107, 114, 128); font-size: 1.125rem;">
                            لا توجد أقسام أو منتجات في هذا الفرع
                        </p>
                    </div>
                </x-filament::section>
            @endforelse

        @else
            {{-- حالة عدم اختيار فرع --}}
            <x-filament::section>
                <div style="display: flex; flex-direction: column; align-items: center; padding: 4rem 0;">
                    <div style="background: rgb(243, 244, 246); padding: 1.5rem; border-radius: 9999px; margin-bottom: 1.5rem;">
                        <svg style="width: 4rem; height: 4rem; color: rgb(156, 163, 175);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem; color: rgb(17, 24, 39);">
                        مرحباً بك في قائمة الطعام
                    </h3>
                    <p style="color: rgb(107, 114, 128); text-align: center; max-width: 28rem;">
                        الرجاء اختيار فرع من القائمة أعلاه لعرض المنتجات والأقسام المتاحة
                    </p>
                </div>
            </x-filament::section>
        @endif
    </div>
</x-filament-panels::page>