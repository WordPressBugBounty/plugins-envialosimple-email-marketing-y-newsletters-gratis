<?php global $lang; ?>
<script>
    Vue.component('modal-confirm-component', {
        data () {
            return {
            }
        },
        methods: {
            toggle: function() {
                this.show = !this.show;
            },
            acceptAction: function() {
                this.accept();
            },
            cancelAction: function() {
                this.cancel();
            }
        },
        props: ['show','text','accept','cancel'],
        template: `
            <div class="modalBlock " v-if="show" v-bind:class="{ show: show }">
                <div class="modal-content">
                    <div class="modal-body">
                        {{text}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" v-if="this.accept" class="btn btn-sm btn-primary" v-on:click="acceptAction"><?php echo esc_html(__("Aceptar","envialosimple-email-marketing-y-newsletters-gratis")); ?></button>
                        <button type="button" v-if="this.cancel" class="btn btn-sm" v-on:click="cancelAction"><?php echo esc_html(__("Cancelar","envialosimple-email-marketing-y-newsletters-gratis")); ?></button>
                    </div>
                </div>
            </div>
        `
    })
</script>
