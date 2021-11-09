<template>
    <lit-base-field
        :field="field"
        :model="model"
        :value="value"
        v-slot:default="{ state }"
        v-on="$listeners"
    >
        <b-input-group :size="field.size">
            <b-input-group-prepend is-text v-if="field.prepend">
                <span v-html="field.prepend"></span>
            </b-input-group-prepend>

            <vue-dropzone 
                :ref="`dropzone-${field.id}`"
                id="dropzone"
                :id="`dropzone-${field.id}`"
                :options="dropzoneOptions"
                @vdropzone-sending="busy = true"
                @vdropzone-success="uploadSuccess"
                @vdropzone-queue-complete="queueComplete"

            ></vue-dropzone>

            <div class="lit-dropzone-busy" v-if="busy">
                <b-spinner variant="secondary"></b-spinner>
            </div>

            <b-input-group-append is-text v-if="field.append">
                <span v-html="field.append"></span>
            </b-input-group-append>
        </b-input-group>

        <slot />
    </lit-base-field>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import { mapGetters } from 'vuex';
export default {
    name: 'ZipImage',
    props: {
        /**
         * Field attributes.
         */
        field: {
            required: true,
            type: Object,
        },

        /**
         * Model.
         */
        model: {
            required: true,
            type: Object,
        },

        /**
         * Field value.
         */
        value: {
            required: true,
        },
    },
    components: {
        vueDropzone: vue2Dropzone,
    },
    data() {
        return {
            dropzoneOptions: {
                url: '',
                thumbnailWidth: 150,
                maxFilesize: 100,
                timeout: 600000,
                method: 'POST',
                paramName: this.field.id,
                dictDefaultMessage: `<i class="fas fa-file-import d-inline-block"></i> ${this.__(
                    'base.drag_and_drop'
                )}`,
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                    'X-Requested-With': 'XMLHttpRequest',
                },
            },
            busy: false,
        }
    },

    beforeMount() {
        
        // this.media = this.model[this.field.id] || [];

        this.dropzoneOptions.url = this.uploadUrl;

        if (this.field.accept !== true && this.field.accept !== undefined) {
            this.dropzoneOptions.acceptedFiles = this.field.accept;
        }

        // this.images = this.media;
        // // TODO: FIX FOR BLOCK
        // if (Object.keys(this.media)[0] != '0' && !_.isEmpty(this.media)) {
        //     this.images = [this.media];
        // }

        document.addEventListener('keyup', evt => {
            if (evt.keyCode === 27) {
                this.cancel();
            }
        });
    },

    computed: {
        ...mapGetters(['baseURL', 'language']),
        
        /**
         * Dropzone ref.
         */
        dropzone() {
            return this.$refs[`dropzone-${this.field.id}`];
        },

        uploadUrl() {
            return `${this.baseURL}${this.field.route_prefix}/zipimage`;
        },
    },
    methods: {
        /**
         * Cancel cropping.
         */
        cancel() {
            this.dropzone.removeAllFiles();
            this.dropzone.removeAllFiles(true);
            // this.$bvModal.hide(this.cropperId);
        },

        /**
         * Handle upload success.
         */
        uploadSuccess(file, response) {
            this.busy = false;
            this.uploads++;
            this.$bvToast.toast(
                this.__('crud.fields.media.messages.image_uploaded'),
                {
                    variant: 'success',
                }
            );
            // this.images.push(response);
            // this.$bvModal.hide(this.cropperId);
        },

        /**
         * Handle queue complete.
         */
        queueComplete() {
            this.busy = false;
            this.$emit('reload');
            // this.$emit('refresh');
            Lit.bus.$emit('field:updated', 'image:uploaded');
        },
    }
};
</script>
