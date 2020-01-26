<script>
import { Doughnut } from 'vue-chartjs'

export default {
    extends: Doughnut,
    props: ['chartdata'],
    data: () => ({
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    }),
    mounted () {
        this.renderChart(this.chartdata, this.options)
    }
}
</script>

<style>

</style>