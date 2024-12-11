<script lang="ts">
    import { onMount } from 'svelte';
    import Header from '$lib/header/+page.svelte';

    interface ShopItem {
        id: number;
        name: string;
        price: number;
        image: string;
    }

    let shopItems: ShopItem[] = [];
    let showConfirmation = false;
    let selectedItem: ShopItem | null = null;
    let userId: string | null = null;
    let purchasedItems: Set<number> = new Set();
    let equippedBorder: string | null = null;


    onMount(async () => {
        userId = localStorage.getItem('user-id');
        console.log('User ID from localStorage:', userId);

        const response = await fetch('http://localhost/codemaster/codemasters-backend/modules/inventory.php');
        const data = await response.json();
        if (data.status === 'success') {
            shopItems = data.data.map((item: any) => ({
                id: item.item_no,
                name: item.item_name,
                price: item.item_price,
                image: item.item_image
            }));

            await checkPurchasedItems();
        }

        const response2 = await fetch(`http://localhost/codemaster/codemasters-backend/modules/check_border.php?userId=${userId}`);
        const borderData = await response2.json();
        if (borderData.status === 'success') {
            equippedBorder = borderData.purchasedItems[0]; // Assuming the first item is the current border
            console.log('Current User Avatar Border:', equippedBorder); // Log the current user avatar border

        }
    });

    async function checkPurchasedItems() {
        const response = await fetch(`http://localhost/codemaster/codemasters-backend/modules/check_purchases.php?userId=${userId}`);
        const data = await response.json();
        if (data.status === 'success') {
            data.purchasedItems.forEach((itemId: number) => purchasedItems.add(Number(itemId)));
        }
        const purchaseIDs = Array.from(purchasedItems);
        
        console.log('Saving purchase IDs:', purchaseIDs);
        localStorage.setItem('purchaseIDs', JSON.stringify(purchaseIDs));
    }

    function handleBuy(item: ShopItem) {
        selectedItem = item;
        showConfirmation = true;
        console.log('User ID:', userId);
        console.log('Selected Item:', {
            id: item.id,
            name: item.name,
            price: item.price,
            image: item.image
        });
    }

    async function confirmPurchase() {
        if (selectedItem) {
            const response = await fetch('http://localhost/codemaster/codemasters-backend/modules/purchase.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    userId: userId,
                    itemId: selectedItem.id,
                    itemName: selectedItem.name,
                    itemPrice: selectedItem.price,
                    itemImage: selectedItem.image,
                }),
            });

            const result = await response.json();
            if (result.status === 'success') {
                // Deduct the item's price from user-diamonds
                const updateResponse = await fetch('http://localhost/codemaster/codemasters-backend/modules/update_diamonds.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        userId: userId,
                        diamondsToDeduct: selectedItem.price,
                    }),
                });

                const updateResult = await updateResponse.json();
                if (updateResult.status === 'success') {
                    alert(`You have purchased ${selectedItem.name}!`);
                } else {
                    alert('Failed to update diamond balance.');
                }
            } else {
                alert('Failed to complete the purchase.');
            }
        }
        showConfirmation = false;
        selectedItem = null;
    }

    function cancelPurchase() {
        showConfirmation = false;
        selectedItem = null;
    }

    function getButtonLabel(item: ShopItem) {
        const purchaseIDs = JSON.parse(localStorage.getItem('purchaseIDs') || '[]');
        
        // Convert both values to numbers for comparison
        const hasPurchased = purchaseIDs.some((id: number | string) => Number(id) === Number(item.id));
        
        // Check if the item is equipped
        const isEquipped = equippedBorder === item.image;

        if (isEquipped) {
            return 'Equipped';
        } else if (hasPurchased) {
            return 'Equip';
        } else {
            return 'Buy';
        }
    }

    async function handleEquip(item: ShopItem) {
        console.log('User ID:', userId);
        console.log('Border Name:', item.image);
        try {
            const response = await fetch('http://localhost/codemaster/codemasters-backend/modules/update_border.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    userId: userId,
                    borderName: item.image
                }),
            });

            const result = await response.json();
            if (result.status === 'success') {
                equippedBorder = item.image;
                alert(`${item.name} has been equipped!`);
                window.location.reload();
            } else {
                alert(`Failed to equip the border: ${result.message}`);
            }
        } catch (error) {
            console.error('Error during equip operation:', error);
            alert('An error occurred while trying to equip the border.');
        }
    }

</script>

<div class="h-screen bg-gradient-to-b from-gray-900 to-black">
    <div class="w-full flex justify-center">
        <Header />
    </div>
    
    <div class="container mx-auto px-0 mt-8 w-screen h-[calc(100vh-140px)]">
        <!-- Shop Section -->
        <div class="bg-gray-800 rounded-lg p-4">
            <h2 class="text-2xl font-bold text-white mb-2">Shop</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                {#each shopItems as item}
                    <div class={`bg-gray-700 rounded-lg p-2 hover:bg-gray-600 transition-colors ${equippedBorder === item.image ? 'border-2 border-green-500' : ''}`}>
                        <h3 class="text-lg font-semibold text-white text-center">{item.name}</h3>
                        <img src={`/borders/${item.image}`} alt={item.name} class="w-full h-auto object-cover mb-1" />
                        <div class="flex justify-between items-center mt-1">
                            <span class="text-yellow-400">
                                <img src="diamond.png" alt="Diamond" class="inline-block w-6 h-6 mt-[-3px]" />{item.price} coins
                            </span>
                            <button 
                                class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md text-xs" 
                                on:click={() => {
                                    const hasPurchased = getButtonLabel(item) !== 'Buy';
                                    if (hasPurchased) {
                                        handleEquip(item);
                                    } else {
                                        handleBuy(item);
                                    }
                                }}
                                disabled={getButtonLabel(item) === 'Equipped'}
                            >
                                {getButtonLabel(item)}
                            </button>
                        </div>
                    </div>
                {/each}
            </div>
        </div>

        {#if showConfirmation}
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70">
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full">
                    <h3 class="text-xl font-semibold text-center mb-4 text-white">{selectedItem?.name}</h3>
                    <img src={`/borders/${selectedItem?.image}`} alt={selectedItem?.name} class="w-full h-auto object-cover mb-4 rounded" />
                    <p class="text-center mb-4 text-white">Are you sure you want to buy this for <span class="font-bold"> 
                        <img src="diamond.png" alt="Diamond" class="inline-block w-6 h-6 mt-[-3px]" />{selectedItem?.price} coins</span>?</p>
                    <div class="flex justify-around mt-4">
                        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition" on:click={confirmPurchase}>Buy</button>
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition" on:click={cancelPurchase}>Cancel</button>
                    </div>
                </div>
            </div>
        {/if}
    </div>
</div>
