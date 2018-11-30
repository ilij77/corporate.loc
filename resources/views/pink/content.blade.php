@if($portfolio && count($portfolio)>0)

<div id="content-home" class="content group">
    <div class="hentry group">
        <div class="section portfolio">

            <h3 class="title">Latest projects</h3>
            @foreach($portfolio as $k=>$item)

@if($k==0)
                    <div class="hentry work group portfolio-sticky portfolio-full-description">
                        <div class="work-thumbnail">
                            <a class="thumb"><img src="{{asset(env('THEME'))}}/images/projects/0081-385x192.jpg" alt="0081" title="0081" /></a>
                            <div class="work-overlay">
                                <h3><a href="{{--route('portfolio.show')--}}">{{$item->title}}</a></h3>
                                <p class="work-overlay-categories"><img src="{{asset(env('THEME'))}}/images/categories.png" alt="Categories" /> in: <a href="category.html">Brand Identity</a>, <a href="category.html">Web Design</a></p>
                            </div>
                        </div>
                        <div class="work-description">
                            <h2><a href="project.html">{{$item->title}}</a></h2>
                            <p class="work-categories">in: <a href="#">{{$item->filter->title}}</a></p>
                           <p> {{str_limit($item->text,200)}}</p>
                                <a href="#" class="read-more">|| Read more</a>
                        </div>
                    </div>

                    <div class="clear"></div>
    @continue
    @endif


                @endforeach



            <div class="portfolio-projects">

                <div class="related_project">
                    <div class="overlay_a related_img">
                        <div class="overlay_wrapper">
                            <img src="images/projects/0061-175x175.jpg" alt="0061" title="0061" />
                            <div class="overlay">
                                <a class="overlay_img" href="images/projects/0061.jpg" rel="lightbox" title=""></a>
                                <a class="overlay_project" href="project.html"></a>
                                <span class="overlay_title">Love</span>
                            </div>
                        </div>
                    </div>
                    <h4><a href="project.html">Love</a></h4>
                    <p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, [...]
                </div>

                <div class="related_project">
                    <div class="overlay_a related_img">
                        <div class="overlay_wrapper">
                            <img src="images/projects/0071-175x175.jpg" alt="0071" title="0071" />
                            <div class="overlay">
                                <a class="overlay_img" href="images/projects/0071.jpg" rel="lightbox" title=""></a>
                                <a class="overlay_project" href="project.html"></a>
                                <span class="overlay_title">Kineda</span>
                            </div>
                        </div>
                    </div>
                    <h4><a href="project.html">Kineda</a></h4>
                    <p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, [...]
                </div>

                <div class="related_project">
                    <div class="overlay_a related_img">
                        <div class="overlay_wrapper">
                            <img src="images/projects/009-175x175.jpg" alt="009" title="009" />
                            <div class="overlay">
                                <a class="overlay_img" href="images/projects/009.jpg" rel="lightbox" title=""></a>
                                <a class="overlay_project" href="project.html"></a>
                                <span class="overlay_title">Guanacos</span>
                            </div>
                        </div>
                    </div>
                    <h4><a href="project.html">Guanacos</a></h4>
                    <p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, [...]
                </div>

                <div class="related_project_last related_project">
                    <div class="overlay_a related_img">
                        <div class="overlay_wrapper">
                            <img src="images/projects/0011-175x175.jpg" alt="0011" title="0011" />
                            <div class="overlay">
                                <a class="overlay_img" href="images/projects/0011.jpg" rel="lightbox" title=""></a>
                                <a class="overlay_project" href="project.html"></a>
                                <span class="overlay_title">Miller Bob</span>
                            </div>
                        </div>
                    </div>
                    <h4><a href="project.html">Miller Bob</a></h4>
                    <p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, [...]
                </div>

            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!-- START COMMENTS -->
    <div id="comments">
    </div>
    <!-- END COMMENTS -->
</div>
    @else
<p>Нет содержимого</p>
    @endif