
<script>
/**
 * 템플릿에서 제공하는 아이콘 컴포넌트
 * 아이콘 리스트는 https://vue-feather-icons.netlify.com/ 여기서 참고
 */
import * as icons from 'vue-feather-icons';

export default {
    name: 'feather-icon',
    props: {
        icon: { type: String, required: true },
        svgClasses: { type: [String, Object, Array], default: '' },
        badge: {},
    },
    render(h) {
        const svg = h(icons[this.icon], { class: this.svgClasses });
        const badgeEl = h(
            'span',
            {
                class:
          'feather-icon-badge bg-primary text-white absolute px-2 py-1 rounded-full text-xs',
                style: 'top: -9px; right: -7px',
            },
            [this.badge],
        );
        const attr = {
            class: ['feather-icon select-none relative'],
            on: {
                click: this.clickFeather,
                mouseover: this.mouseoverFeather,
                mouseout: this.mouseoutFeather,
            },
        };
        const children = [svg];
        if (this.badge) children.push(badgeEl);
        return h('span', attr, children);
    },
    methods: {
        clickFeather(event) {
            this.$emit('click', event);
        },
        mouseoverFeather(event) {
            this.$emit('mouseover', event);
        },
        mouseoutFeather(event) {
            this.$emit('mouseout', event);
        },
    },
};
</script>

<style>
@import "../assets/scss/vuesax/components/featherIcon.scss";
</style>
