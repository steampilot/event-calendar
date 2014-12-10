/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2004-2014 odan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

if (!$d) {
	$d = {};
}

$d.Upload = function () {

	var $this = this;

	/**
	 * Image uploader
	 * http://hayageek.com/drag-and-drop-file-upload-jquery/
	 *
	 * @param {object} options
	 * options.image {object} the image html elemen
	 * options.onupload    {object} callback function
	 * options.onimageload {object} callback function
	 * options.input {object} the htlm input upload elemement
	 * options.global {boolean}
	 *
	 * @returns {undefined}
	 */
	this.uploadImage = function (options) {

		// allowed filetypes
		var fileTypes = {
			'image/jpeg': 'jpg',
			'image/jpg': 'jpg',
			'image/gif': 'gif',
			'image/png': 'png'
		};

		options = $.extend({
			image: null,
			onupload: $this.onImageUpload,
			onimageload: $this.onImageLoad,
			maxfilesize: 3 * 1024 * 1024,
			global: false,
			filetype: fileTypes
		}, options);

		// Handle drag and drop events
		options.image.on('dragenter', function (e) {
			e.stopPropagation();
			e.preventDefault();
			$(this).css('border', '2px solid #0B85A1');
		});

		options.image.on('dragover', function (e) {
			e.stopPropagation();
			e.preventDefault();
		});

		options.image.on('dragleave', function (e) {
			e.stopPropagation();
			e.preventDefault();
			$(this).css('border', '');
		});

		options.image.on('drop', function (e) {
			e.preventDefault();
			//$(this).css('border', '2px dotted #0B85A1');
			$(this).css('border', '');

			var files = e.originalEvent.dataTransfer.files;
			options.onupload(files, options);
		});

		// Handle click event with file open dialog
		options.image.on('click', function () {
			$(options.input).trigger('click');
		});

		options.input.on('change', function (e) {
			var files = e.dataTransfer ? e.dataTransfer.files : e.target.files;
			options.onupload(files, options);
			// reset
			$(options.input).val('');
		});

		// If the files are dropped outside the div, file is opened in the
		// browser window. To avoid that we can prevent ‘drop’ event on document.
		if (options.global === true) {
			$(document).on('dragenter', function (e) {
				e.stopPropagation();
				e.preventDefault();
			});

			$(document).on('dragover', function (e) {
				e.stopPropagation();
				e.preventDefault();
				//elImage.css('border', '2px dotted #0B85A1');
			});

			$(document).on('drop', function (e) {
				e.stopPropagation();
				e.preventDefault();

				var files = e.originalEvent.dataTransfer.files;
				options.onupload(files, options);

				// Prevent double handler
				e.preventDefault();
			});
		}
	};

	/**
	 * Event onImageUpload
	 *
	 * @param {object} files
	 * @param {object} obj
	 * @returns {undefined}
	 */
	this.onImageUpload = function (files, options) {

		if (!files || files.length < 1) {
			return;
		}

		var reader = new FileReader();
		var file = files[0];

		//var strFileName = file.name;
		var strFileType = file.type;

		if (!(strFileType in options.filetype)) {
			$d.alert(__('The filetype is invalid'));
			return;
		}

		if (file.size > options.maxfilesize) {
			$d.alert(__('The file size exceeds the limit allowed'));
			return;
		}

		reader.onerror = function (event) {
			$d.alert(__("The file could not be opened.") + ' ' + event.target.error.code);
		};

		reader.onload = function (e) {
			options.onimageload(e, options);
		};
		reader.readAsDataURL(file);

	};

	/**
	 * If image is loaded
	 *
	 * @param {object} e
	 * @returns {undefined}
	 */
	this.onImageLoad = function (e, options) {
		var strData = e.target.result;
		// change image
		$(options.image).attr('src', strData);
	};

};
