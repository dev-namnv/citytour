<template>
    <main>

        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Trang chủ</a>
                    </li>
                    <li><a href="#">Tours</a>
                    </li>
                    <li>Tất cả</li>
                </ul>
            </div>
        </div>
        <!-- Position -->


        <div class="container margin_60">

            <div class="row">
                <aside class="col-lg-3">
                    <div class="box_style_cat">
                        <ul id="cat_nav">
                            <li>
                                <a href="tours" id="active"><i class="icon_set_1_icon-51"></i>All tours <span>({{ tours.length }})</span></a>
                            </li>
                            <li v-for="category in categories">
                                <a href="#"><i class="{{ category.icon }}"></i>{{ category.name }}</a>
                            </li>
                        </ul>
                    </div>

                    <div id="filters_col">
                        <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i>Lọc</a>
                        <div class="collapse show" id="collapseFilters">
                            <div class="filter_type">
                                <h6>Giá</h6>
                                <input type="text" id="range" name="range" value="">
                            </div>
                            <div class="filter_type">
                                <h6>Đánh giá</h6>
                                <ul>
                                    <li>
                                        <label>
                                            <input type="checkbox"><span class="rating">
											<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i>
											</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox"><span class="rating">
											<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i>
											</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox"><span class="rating">
											<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>
											</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox"><span class="rating">
											<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i>
											</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="checkbox"><span class="rating">
											<i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i>
											</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="filter_type">
                                <h6>Khởi hành</h6>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                                    </div>
                                </div>
                            </div>
                            <div class="filter_type text-center">
                                <button class="btn btn-field col-12 bold">Cập nhật</button>
                            </div>
                        </div>
                        <!--End collapse -->
                    </div>
                    <!--End filters col-->
                    <div class="box_style_2">
                        <i class="icon_set_1_icon-57"></i>
                        <h4>Need <span>Help?</span></h4>
                        <a href="tel://{!! __('info.hotline') !!}" class="phone">9999988887777</a>
                        <small>10h am</small>
                    </div>
                </aside>
                <!--End aside -->
                <div class="col-lg-9">

                    <div id="tools">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-6">
                                <div class="styled-select-filters">
                                    <select name="sort_price" id="sort_price">
                                        <option value="" selected>Sort by price</option>
                                        <option value="lower">Lowest price</option>
                                        <option value="higher">Highest price</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-6">
                                <div class="styled-select-filters">
                                    <select name="sort_rating" id="sort_rating">
                                        <option value="" selected>Sort by ranking</option>
                                        <option value="lower">Lowest ranking</option>
                                        <option value="higher">Highest ranking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-4 d-none d-sm-block text-right">
                                <a href="/" class="bt_filters"><i class="icon-th"></i></a>
                                <a href="/" class="bt_filters"><i class=" icon-list"></i></a>
                            </div>

                        </div>
                    </div>
                    <!--/tools -->

                    <div v-for="tour in tours" class="strip_all_tour_list wow fadeIn" data-wow-delay="0.{{ 1 }}s">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="wishlist">
                                    <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">{!! __('Add to wishlist') !!}</span></span></a>
                                </div>
                                <div class="img_list">
                                    <a href="/"><img src="/" alt="Image">
                                        <div class="short_info"><i class="{!! $tour->category->icon !!}"></i>{!! $tour->category->name !!} </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="tour_list_desc">
                                    <h3><strong>{{ tour.name }}</strong></h3>
                                    <div v-if="tour.reviews.length > 0" class="small">
                                        Điểm:
                                        <span>{{ tour.reviews.map((star) => star)/tour.reviews.length }}</span>
                                    </div>
                                    <div class="add_info">
                                        <div class="tooltip-item">
                                            Tour <span>
                                                    {{ '10/10/2020' }}
                                                </span> ngày
                                        </div>
                                    </div>
                                    <ul class="add_info">
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                Khởi hành:
                                            </div>
                                        </li>
                                        @foreach($tour->batches as $key => $batch)
                                        @if($key < 5)
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                        <span class="tooltip-item">
                                                            {{ 'hihi' }}
                                                        </span>
                                            </div>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2" style="margin-left: -16px">
                                <div class="price_list" style="width: 145px">
                                    <div class="price">
                                        <p style="font-size: 50%" class="bg-danger text-white p-2">{!! $tour->getCurrentPrice() !!}</p>
                                        <small class="mt-2">/người</small>
                                        <p>
                                            <a href="/" class="btn_1">Chi tiết</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End strip -->

                    <hr>
                    {!! $tours->links() !!}
                    <!-- end pagination-->

                </div>
                <!-- End col lg-9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>
</template>

<script>
export default {
    name: "ListTour",
    data() {
        return {
            categories: [],
            tours: []
        }
    },
    mounted() {
        axios.get(`${BASE_URL}/api_v1/category/list`)
            .then(({data}) => {
                this.categories = data
            })
            .catch((err) => console.log('category err', err))
        axios.get(`${BASE_URL}/api_v1/tour/list`)
            .then(({data}) => {
                this.tours = data
            })
            .catch((err) => console.log('tour err', err))
    }
}
</script>

<style scoped>

</style>
