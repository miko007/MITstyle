<section class="post-container">
	<article class="post">
		<h2>{{title}}</h2>
		<p class="postDetails">
			{{date}}
		</p>
		<section class="postContent">
			{{content}}
		</section>
		{{categories}}
		<section class="postAuthor">
			<img src="{{avatar}}" alt="{{authorName}}">
			<h3>{{authorName}}</h3>
			<p>
				<a href="{{homepage}}">{{homepage}}</a>
			</p>
			<p>
				{{bio}}
			</p>
			<p>
				<a href="{{url}}">mehr von diesem Autor</a>
			</p>
		</section>
		<section class="MITcomments">
			{{comments}}
			{{commentForm}}
		</section>
	</article>
</section>