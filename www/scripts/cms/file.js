/**
 * Created by f.alexsey on 08.08.14.
 */

var _hendlerLOad = function ($self, files) {
	FileAPI.filterFiles(files, function (file, info) {
		if (/^image/.test(file.type)) {
			return  true;
		}
		return  false;
	}, function (files, rejected) {
		if (files.length) {
			// Make preview 100x100
			FileAPI.each(files, function (file) {
				FileAPI.Image(file).preview(200).get(function (err, img) {
					var $htmlDiv = new $('<div class="list-image-item"><div class="list-image-item-canvast"></div></div>');
					$htmlDiv.attr('data-file-name', file.name + file.type);
					$htmlDiv.find('.list-image-item-canvast').append(img);
					$htmlDiv.find('.list-image-item-canvast').append("<div class='list-image-item-progres'></div>");
					$self.parent().parent().find('.list-image').prepend($htmlDiv);
				});
			});

			var group = $self.attr('data-group');
			var multiple = $self.attr('data-img');

			// Uploading Files
			FileAPI.upload({
				url: './',
				data: {group: group, multiple: multiple, images_file: 1},
				files: { images: files },
				progress: function (evt, file) {
					var prosent = evt.loaded / evt.total * 100,
						$item = $('div[data-file-name="'+file.name + file.type+'"]');
					$item.find('.list-image-item-progres').css({
						'width': prosent + '%'
					});
				},
				filecomplete: function (err, xhr, file) {
					var data = JSON.parse(xhr.responseText),
						$item = $('div[data-file-name="'+file.name + file.type+'"]');
					$item.attr('data-file-name', '');
					$item.fadeOut(200, function () {
						if (data['error']) {
							$item.html("<p>");
							$item.find("p").attr("style", "color: #cc4242;").html(data.error);
						}
						else {
							var $block = $('<div class="list-image-item-block">');
							$block.append('<i class="list-image-item-remove fa fa-minus-square-o"></i>');
							$block.append('<a href="'+data.url.replace('200x200', 'originals')+'" target="_blank"><img src="'+data.url+'" /></a>');
							$block.append('<input type="hidden" value="'+group+'" name="cms-form-item['+group+']" />');
							$block.append('<input type="hidden" value="'+data.id+'" name="cms-image-id['+group+']['+data.id+']" />');
							$block.append('<input type="hidden" class="list-image-item-remove-input" value="0" name="cms-image-remove['+group+']['+data.id+']" />');
							$block.append('<input type="text" placeholder="Описание" class="text" value="'+data.caption+'" name="cms-image-caption['+group+']['+data.id+']" />');
							$item.html($block);
							$item.append('<div class="list-image-item-remove-text"><a href="#">Востановить</a></div>');
							if (multiple == 'image' && !data['error'])
							{
								$self.parent().parent().find('.list-image').html($item);
							}
						}
						$item.fadeIn(200);
					});
				}
			});
		}
	});
}


var _hendlerLOadFile = function ($self, files) {
	FileAPI.filterFiles(files, function (file, info) {
		// filter
		return  true;
	}, function (files, rejected) {
		if (files.length) {
			FileAPI.each(files, function (file) {
				var $htmlDiv = new $('<div class="list-file-item"><div class="list-file-item-canvast"></div></div>');
				$htmlDiv.attr('data-file-name', file.name + file.type);
				$htmlDiv.find('.list-file-item-canvast').append("<p>"+file.name+"</p>");
				$htmlDiv.find('.list-file-item-canvast').append("<div class='list-file-item-progres'></div>");
				$self.parent().parent().find('.list-file').prepend($htmlDiv);
			});

			var group = $self.attr('data-group');

			// Uploading Files
			FileAPI.upload({
				url: './',
				data: {group: group, files_file: 1},
				files: { images: files },
				progress: function (evt, file) {
					var prosent = evt.loaded / evt.total * 100,
						$item = $('div[data-file-name="'+file.name + file.type+'"]');
					$item.find('.list-file-item-progres').css({
						'width': prosent + '%'
					});
				},
				filecomplete: function (err, xhr, file) {
					var data = JSON.parse(xhr.responseText),
						$item = $('div[data-file-name="'+file.name + file.type+'"]');
					$item.attr('data-file-name', '');
					$item.fadeOut(200, function () {
						if (data['error']) {
							$item.html("<p>");
							$item.find("p").attr("style", "color: #cc4242;").html(data.error);
						}
						else {
							var $block = $('<div class="list-file-item-block">');
							$block.append('<a href="'+data.url+'" target="_blank"><i class="fa fa-file"></i></a>');
							$block.append('<input type="hidden" value="'+group+'" name="cms-form-item['+group+']" />');
							$block.append('<input type="hidden" value="'+data.id+'" name="cms-file-id['+group+']['+data.id+']" />');
							$block.append('<input type="hidden" class="list-file-item-remove-input" value="0" name="cms-file-remove['+group+']['+data.id+']" />');
							$block.append('<input type="text" placeholder="Описание" class="text" value="'+data.caption+'" name="cms-file-caption['+group+']['+data.id+']" />');
							$block.append('<i class="list-file-item-remove fa fa-minus-square-o"></i>');
							$item.html($block);
							$item.append('<div class="list-file-item-remove-text"><a href="#">Востановить</a></div>');
						}
						$item.fadeIn(200);
					});
				}
			});
		}
	});
}


$(function () {
	var $filesOject = $(".files-image");

	if ($filesOject.size() > 0) {
		$filesOject.each(function () {

			FileAPI.event.dnd($(this).parent()[0], function (over) {
				this.style.backgroundColor = over ? '#cd5': '';
			}, function (files) {
				var $self = $(this).find('input'),
					count = files.length;
				if ($self.attr('data-img') == 'image' && count == 1)
				{
					_hendlerLOad($self, files);
				} else if($self.attr('data-img') == 'images' && count > 0) {
					_hendlerLOad($self, files);
				}

			});

			FileAPI.event.on(this, 'change', function (evt) {
				var $self = $(this),
					files = FileAPI.getFiles(evt);
				_hendlerLOad($self, files);
			});
		});
	}


	$filesOjectFile = $(".files-file");

	if ($filesOjectFile.size() > 0) {
		$filesOjectFile.each(function () {

			FileAPI.event.dnd($(this).parent()[0], function (over) {
				this.style.backgroundColor = over ? '#cd5': '';
			}, function (files) {
				var $self = $(this).find('input'),
					count = files.length;
				if(count > 0) {
					_hendlerLOadFile($self, files);
				}

			});

			FileAPI.event.on(this, 'change', function (evt) {
				var $self = $(this),
					files = FileAPI.getFiles(evt);
				_hendlerLOadFile($self, files);
			});
		});
	}
});


$(document).on('click', '.list-image-item-remove-text a', function () {
	$(this).parents('.list-image-item').find('.list-image-item-remove-text').hide();
	$(this).parents('.list-image-item').find('.list-image-item-remove-input').val(0);
	$(this).parents('.list-image-item').find('.list-image-item-block').show();
	return false;
});

$(document).on('click', '.list-image-item-remove', function () {
	$(this).parents('.list-image-item').find('.list-image-item-remove-text').show();
	$(this).parents('.list-image-item').find('.list-image-item-remove-input').val(1);
	$(this).parents('.list-image-item').find('.list-image-item-block').hide();
	return false;
});

$(document).on('click', '.list-file-item-remove-text a', function () {
	$(this).parents('.list-file-item').find('.list-file-item-remove-text').hide();
	$(this).parents('.list-file-item').find('.list-file-item-remove-input').val(0);
	$(this).parents('.list-file-item').find('.list-file-item-block').show();
	return false;
});

$(document).on('click', '.list-file-item-remove', function () {
	$(this).parents('.list-file-item').find('.list-file-item-remove-text').show();
	$(this).parents('.list-file-item').find('.list-file-item-remove-input').val(1);
	$(this).parents('.list-file-item').find('.list-file-item-block').hide();
	return false;
});