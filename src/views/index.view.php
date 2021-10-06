<bs:resources />

<router:fromPath>
    <router:directory path="_">
        <router:file name="edit" path="edit">
            <pages:edit />
        </router:file>
    </router:directory>
    <router:file path="*">
        Hello, Wiki!
    </router:file>
</router:fromPath>

<router:render />