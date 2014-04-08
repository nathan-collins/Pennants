<div class="col-sm-8">
	<div class="timeline">
		@if (!$posts->isEmpty())
			@foreach ($posts as $post)
				<div class="blg-summary item{{ $post->is_sticky ? ' item__sticky' : '' }}">

					<h3 class="item--title">
						<a href="{{ $post->getUrl() }}" title="{{ $post->title }}">
							{{ $post->title }}
						</a>
					</h3>
					<div class="timeline-info hidden-xs">
			      <img src="img/client-2.jpg" class="blg-author" alt="...">
						<time datetime="{{ $post->getDate() }}" class="hidden-xs">{{ $post->getDate() }}</time>
					</div>
					<ul class="text-muted list-inline blg-header">
				  	<li><i class="fa fa-user"></i> <a href="profile.html">Administrator</a></li>
				  	<li><i class="fa fa-calendar"></i>{{ $post->getDate() }}</li>
			    </ul>
					<hr />
					<p class="blg-text">
						@if (!empty($post->you_tube_video_id))
							<a href="{{ $post->getUrl() }}" title="{{ $post->title }}">
								{{ $post->getYouTubeThumbnailImage() }}
							</a>
						@elseif (!empty($post->main_image))
							<a href="{{ $post->getUrl() }}" title="{{ $post->title }}">
								{{ $post->getImage('main_image', 'thumbnail') }}
							</a>
						@endif
						{{ $post->summary }}
					</p>
					<p class="tags">

					</p>

				</div>

			@endforeach

			{{ $posts->links() }}

		@else

			<p class="item-list--empty">
				{{ trans('laravel-blog::messages.list.no_items') }}
			</p>

		@endif
	</div>
</div>