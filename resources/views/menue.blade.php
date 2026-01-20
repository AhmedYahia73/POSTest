<div style="direction: ltr; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 20px; background-color: #f8fafc; min-height: 100vh;">
    
    <div style="display: flex; gap: 2rem; align-items: flex-start;">
          
        {{-- Main Column: Categories & Products --}}
        <div style="flex: 1;">
            @if($branch_id)
                @php
                    $branch = \App\Models\Branch::find($branch_id);
                    $categories = \App\Models\Category::with(['products' => function($query) use($branch_id) {
                        $query->where('branch_id', $branch_id);
                    }])->get()->filter(fn($cat) => $cat->products->count() > 0);
                @endphp

                <div style="margin-bottom: 2rem;">
                    <h1 style="font-size: 1.8rem; color: #0f172a; margin-bottom: 0.5rem;">{{ $branch?->name }} Menu</h1>
                    <p style="color: #64748b;">Showing {{ $categories->count() }} active categories</p>
                </div>

                @forelse($categories as $category)
                    <div style="margin-bottom: 3rem;">
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                            <h2 style="font-size: 1.4rem; color: #1e293b; margin: 0; text-transform: capitalize;">{{ $category->name }}</h2>
                            <span style="height: 2px; flex: 1; background: #e2e8f0;"></span>
                            <span style="background: #eff6ff; color: #2563eb; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                {{ $category->products->count() }} Items
                            </span>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem;">
                            @foreach($category->products as $product)
                                <div style="background: white; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; transition: transform 0.2s;">
                                    <div style="height: 160px; background: #f1f5f9; position: relative;">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #cbd5e1;">
                                                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </div>
                                        @endif
                                        <div style="position: absolute; bottom: 10px; right: 10px; background: rgba(255,255,255,0.9); padding: 4px 8px; border-radius: 6px; font-weight: bold; color: #0f172a; font-size: 0.9rem; backdrop-filter: blur(4px);">
                                            ${{ number_format($product->price, 2) }}
                                        </div>
                                    </div>
                                    
                                    <div style="padding: 1.25rem;">
                                        <h4 style="margin: 0 0 0.5rem 0; color: #1e293b; font-size: 1.05rem;">{{ $product->name }}</h4>
                                        <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 1.25rem; line-height: 1.5;">
                                            {{ Str::limit($product->description ?? 'No description available for this item.', 60) }}
                                        </p>
                                        <button style="width: 100%; padding: 8px; background: #0f172a; color: white; border: none; border-radius: 6px; font-weight: 500; cursor: pointer;">
                                            Add to Order
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 50px; background: white; border-radius: 12px; color: #94a3b8;">
                        No products found in this branch.
                    </div>
                @endforelse
            @else
                {{-- Empty State --}}
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 60vh; background: white; border-radius: 16px; border: 2px dashed #e2e8f0;">
                    <div style="color: #cbd5e1; margin-bottom: 1rem;">
                        <svg width="64" height="64" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h2 style="color: #475569; margin-bottom: 0.5rem;">Ready to view the menu?</h2>
                    <p style="color: #94a3b8;">Please select a branch from the left sidebar to begin.</p>
                </div>
            @endif
        </div>
    </div>
</div>