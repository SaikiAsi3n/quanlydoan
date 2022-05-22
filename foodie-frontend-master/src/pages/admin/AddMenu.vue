<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Thêm đồ án</h2>
            
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Mã sinh viên</label>
                                <input type="text" v-model="menuItem.user_id" class="form-control" placeholder="Mã sinh viên">
                            </div>

                            <div class="form-group">
                                <label for="">Tên lớp</label>
                                <input type="text" v-model="menuItem.classes" class="form-control" placeholder="Lớp">
                            </div>

                            <div class="form-group">
                                <label for="">Mức GPA</label>
                                <input type="text" v-model="menuItem.GPA" class="form-control" placeholder="Điểm GPA">
                            </div>

                            <div class="form-group">
                                <label for="">Tên đồ án</label>
                                <input type="text" v-model="menuItem.name" class="form-control" placeholder="Tên đồ án">
                            </div>

                            <div class="form-group">
                                <label for="">Nhận xét</label>
                                <input type="text" v-model="menuItem.comment" class="form-control" placeholder="Nhận xét">
                            </div>

                            <div class="form-group">
                                <label for="">Sinh viên</label>
                                <select v-model="menuItem.category_id" class="form-control">
                                    <option value="">Choose</option>
                                    <option :value="category.id" v-for="(category, index) in categories" :key="index">
                                        {{category.name}}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Mức đánh giá</label>
                                <input type="number" v-model="menuItem.price" min="1" class="form-control" placeholder="Số điểm">
                            </div>

                            <div class="form-group">
                                <label for="">image</label>
                                <input type="file" @change="saveImage($event)" class="form-control">
                            </div>
                            

                            <div class="form-group">
                                <button type="button" @click="addItem" class="btn btn-main">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </dashboard-layout>
</template>

<script>
import DashboardLayout from '@/components/Layouts/DashboardLayout'

export default {
    name: 'AddMenu',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            categories: [],
            menuItem: {
                name: '',
                isAvailable: true,
                category_id: '',
                price: '',
                image: '',
                GPA: '',
                classes: '',
                comment: '',
                user_id: '',
            }
        }
    },
    mounted() {
        this.getCategories()
    },
    methods: {
        getCategories() {
            this.$axios.get(`${this.$apiUrl}/categories/all`)
            .then(res => {
                this.categories = res.data.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        async saveImage(e) {
            const imageData = new FormData()
            imageData.append('file', e.target.files[0])
            imageData.append('upload_preset', 'insta-clone')
            imageData.append('cloud', 'coderesource')

            try {
                const result = await this.$axios.post(`https://api.cloudinary.com/v1_1/coderesource/image/upload`, imageData);
                this.menuItem.image = result.data.url
            }catch(error) {
                console.log(error.response);
            }
        },
        addItem() {
            const {name, price, GPA, classes, comment, user_id, category_id, image, isAvailable} = this.menuItem
            
            if(!name || !price || !category_id || !image || !GPA || !classes || !comment || !user_id ) {
                return this.$alertify.error('Incomplete form data')
            }

            this.$axios.post(`${this.$apiUrl}/menu/add`, {name, price, category_id, image, isAvailable, GPA, classes, comment, user_id}, {
                headers: {
                    Authorization: `Bearer ${localStorage.authtoken}`
                }
            })
            .then(() => {
                this.$router.push('/admin/menu')
            })
            .catch(error => {
                if(error.response.data.message) {
                    return this.$alertify.error(error.response.data.message)
                }
                this.$alertify.error(Object.values(error.response.data)[0][0])
            })
        }
    }
}
</script>

<style lang="css">
    .pad-1 {
        padding: 1rem
    }
</style>