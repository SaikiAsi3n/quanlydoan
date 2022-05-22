<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Đồ án</h2>
                    
            <div class="page-action">
                <button class="btn btn-main" @click="$router.push('/admin/menu/add')"><span class="ti-plus"></span> Thêm đồ án</button>
            </div>
            
            
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Danh sách đồ án</h3>
                        
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Đồ án</th>
                                        <th>Name</th>
                                        <th>Mức đánh giá</th>
                                        <th>Available?</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(menuItem, index) in menu" :key="index" >
                                        <td>#{{index + 1}}</td>
                                        <td><img :src="menuItem.image" style="border-radius: 50%" height="50px" width="50px" alt=""></td>
                                        <td>{{menuItem.name}}</td>
                                        <td>{{menuItem.category.name}}</td>
                                        <td>{{menuItem.price}}</td>
                                        <td>
                                            <span class="badge success" v-if="Number(menuItem.isAvailable) === 1">Available</span>
                                            <span class="badge warning" v-else>Not available</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-main-gradient" @click="removeMenu(menuItem.id, index)"><span class="ti-trash"></span></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </dashboard-layout>
</template>

<script>
import DashboardLayout from '@/components/Layouts/DashboardLayout'

export default {
    components: {
        DashboardLayout
    },
    name: 'Menu',
    data() {
        return {
            menu: []
        }
    },
    mounted() {
        this.getMenu()
    },
    methods: {
        getMenu() {
            this.$axios.get(`${this.$apiUrl}/menu/all`)
            .then(res => {
                this.menu = res.data.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        removeMenu(id, index) {
            this.$axios.delete(`${this.$apiUrl}/menu/${id}/delete`, {
                headers: {
                    Authorization: `Bearer ${localStorage.authtoken}`
                }
            })
            .then(() => {
                this.$alertify.success('Menu item deleted successfully')
                this.menu.splice(index, 1)
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
}
</script>