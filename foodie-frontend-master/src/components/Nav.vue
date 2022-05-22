<template>
    <div>
        <div class="front-header">
            <nav>
                <div>
                    <h3 style="color: red">PTIT</h3>
                    <small>Đồ án tốt nghiệp</small>
                </div>

                <div class="front-search">
                    <span class="ti-search"></span>
                    <input type="search" placeholder="Search or scan for items" />
                </div>

                <div class="front-nav-links">
                    <div v-if="user === null">
                        <router-link to="/account"><small>Login</small></router-link> | <router-link to="/account"><small>Register</small></router-link>
                    </div>

                    <div v-else>
                        <button class="btn-link" ><small><span class="ti-user"></span> Profile</small></button> | <button class="btn-link" @click="signout"><small><span class="ti-power-off"></span> Logout</small></button>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Nav',
    props: ['user', 'cart', 'categories'],
    methods: {
        signout() {
            localStorage.removeItem('user')
            localStorage.removeItem('token')
            location.reload()
        }
    }
}
</script>