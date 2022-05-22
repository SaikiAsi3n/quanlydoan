<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Tổng quan</h2>
            
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Danh sách đồ án</h3>
                        
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên sinh viên</th>
                                        <th>Mã sinh viên</th>
                                        <th>Lớp</th>
                                        <th>Ảnh</th>
                                        <th>Tên Đồ án</th>
                                        <th>Mức đánh giá</th>
                                        <th>Nhận xét</th>
                                        <th>GPA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(menuItem, index) in menu" :key="index" >
                                        <td>#{{index + 1}}</td>
                                        <td>{{menuItem.category.name}}</td>
                                        <td>{{menuItem.user_id}}</td>
                                        <td>{{menuItem.classes}}</td>
                                        <td><img :src="menuItem.image" style="border-radius: 50%" height="50px" width="50px" alt=""></td>
                                        <td>{{menuItem.name}}</td>
                                        <td>{{menuItem.price}}</td>
                                        <td>{{menuItem.comment}}</td>
                                        <td>{{menuItem.GPA}}</td>
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
    name: 'AdminHome',
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
                this.menu = res.data.data.slice(0, 3)
                console.log(this.menu)
            })
            .catch(error => {
                console.log(error.response)
            })
        },
    }
}
</script>