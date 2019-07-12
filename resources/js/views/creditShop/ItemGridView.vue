
<template>
    <div class="item-grid-view vx-row match-height ">
        <div class="vx-col sm:w-1/4 w-full mt-4 ml-4" v-for="item in items" :key="item.objectID">
            <case-card class="grid-view-item mb-base overflow-hidden">
                <template slot="no-body">

                    <!-- ITEM IMAGE -->
                    <div class="item-img-container bg-white h-64 flex items-center justify-center mb-4 ">
                        <img :src="require(`@/assets/images/shop/${item.image}`)" :alt="item.name" class="grid-view-img px-4">
                    </div>
                    <div class="item-details px-4">

                        <!-- RATING & PRICE -->
                        <div class="flex justify-between items-center">
                            <div class="bg-primary flex text-white py-1 px-2 rounded">
                                <span class="text-sm">{{ item.rating }}</span>
                                <feather-icon icon="StarIcon" svgClasses="h-4 w-4" />
                            </div>
                            <h6 class="font-bold text-warning">${{ item.price }}</h6>
                        </div>

                        <!-- TITLE & DESCRIPTION -->
                        <div class="my-4">
                            <vs-button class="float-right px-6 mb-5" type="border">구매</vs-button>
                            <div>
                              <p class="item-description truncate text-sm">{{ item.company }}</p>
                              <h6 class="truncate font-semibold mb-1">{{ item.name }}</h6>
                            </div>
                        </div>
                    </div>

                    <!-- SLOT: ACTION BUTTONS -->
                    <slot name="action-buttons" />
                </template>
            </case-card>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [
                { name: '아메리카노', image: 'coffee.jpg', price: '5,000p', company: '이디야' },
                { name: '러블리어피치 얼굴쿠션', image: 'apeach_item.jpg', price: '20,000p', company: '카카오프렌즈' },
                { name: '피큐어키링_니니즈', image: 'figure.jpg', price: '11,500p', company: '카카오프렌즈' },
                { name: '허니프렌즈 소프트인형', image: 'honey.jpg', price: '35,000p', company: '카카오프렌즈' },
                { name: '민트초코설빙', image: 'ice.png', price: '10,900p', company: '설빙' },
            ],
        };
    },
    created() {
        console.log(this.items);
    },
};
</script>

<style lang="scss" scoped>
.grid-view-item {
    .grid-view-img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        transition: .35s;
    }

    &:hover {
        transform: translateY(-5px);
        box-shadow: 0px 4px 25px 0px rgba(0,0,0,.25);

        .grid-view-img{
            opacity: 0.9;
        }
    }
}
</style>
