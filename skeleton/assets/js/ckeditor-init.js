/**
 * This configuration was generated using the CKEditor 5 Builder. You can modify it anytime using this link:
 * https://ckeditor.com/ckeditor-5/builder/?redirect=portal#installation/NoNgNARATAdA7DArBSBGOAWKBODeDM2q2ADHFFMRiBoYoqqhfoqdiFABxycickoIAMwBOKEmGCowEidLkBdSCHwBDAKZkoEBUA==
 */

import {
	ClassicEditor,
	Alignment,
	AutoImage,
	AutoLink,
	Autosave,
	BlockQuote,
	Bold,
	Bookmark,
	CloudServices,
	Code,
	CodeBlock,
	Emoji,
	Essentials,
	Fullscreen,
	GeneralHtmlSupport,
	Heading,
	Highlight,
	HorizontalLine,
	ImageBlock,
	ImageCaption,
	ImageInline,
	ImageInsertViaUrl,
	ImageResize,
	ImageStyle,
	ImageTextAlternative,
	ImageToolbar,
	ImageUpload,
	Indent,
	IndentBlock,
	Italic,
	Link,
	List,
	ListProperties,
	Mention,
	Paragraph,
	SpecialCharacters,
	SpecialCharactersArrows,
	SpecialCharactersCurrency,
	SpecialCharactersEssentials,
	SpecialCharactersLatin,
	SpecialCharactersMathematical,
	SpecialCharactersText,
	Style,
	Table,
	TableCaption,
	TableCellProperties,
	TableColumnResize,
	TableProperties,
	TableToolbar,
	TodoList,
	Underline,
	WordCount
} from './CKEditor/ckeditor5.js';

import translations from './CKEditor/translations/fr.js';

const LICENSE_KEY =
	'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NTk1MzU5OTksImp0aSI6IjU2YzRiMGM2LWZhYzktNGY1OS05YjljLTZiMmM1MWM5OTAyNyIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6IjYxZTU3MTg0In0.DQV1-t3hGH28qb5CI_vICOOSr9ZdiqqXGgPaTLICRuHLAb5nXp6ScyY8AV4tJdLjauBV9YFvUXX6iNDkjlrJag';

const editorConfig = {
	toolbar: {
		items: [
			'undo',
			'redo',
			'|',
			'fullscreen',
			'|',
			'heading',
			'style',
			'|',
			'bold',
			'italic',
			'underline',
			'code',
			'|',
			'emoji',
			'specialCharacters',
			'horizontalLine',
			'link',
			'bookmark',
			'insertTable',
			'highlight',
			'blockQuote',
			'codeBlock',
			'|',
			'alignment',
			'|',
			'bulletedList',
			'numberedList',
			'todoList',
			'outdent',
			'indent'
		],
		shouldNotGroupWhenFull: true
	},
	plugins: [
		Alignment,
		AutoImage,
		AutoLink,
		Autosave,
		BlockQuote,
		Bold,
		Bookmark,
		CloudServices,
		Code,
		CodeBlock,
		Emoji,
		Essentials,
		Fullscreen,
		GeneralHtmlSupport,
		Heading,
		Highlight,
		HorizontalLine,
		ImageBlock,
		ImageCaption,
		ImageInline,
		ImageInsertViaUrl,
		ImageResize,
		ImageStyle,
		ImageTextAlternative,
		ImageToolbar,
		ImageUpload,
		Indent,
		IndentBlock,
		Italic,
		Link,
		List,
		ListProperties,
		Mention,
		Paragraph,
		SpecialCharacters,
		SpecialCharactersArrows,
		SpecialCharactersCurrency,
		SpecialCharactersEssentials,
		SpecialCharactersLatin,
		SpecialCharactersMathematical,
		SpecialCharactersText,
		Style,
		Table,
		TableCaption,
		TableCellProperties,
		TableColumnResize,
		TableProperties,
		TableToolbar,
		TodoList,
		Underline,
		WordCount
	],
	fullscreen: {
		onEnterCallback: container =>
			container.classList.add(
				'editor-container',
				'editor-container_classic-editor',
				'editor-container_include-style',
				'editor-container_include-word-count',
				'editor-container_include-fullscreen',
				'main-container'
			)
	},
	heading: {
		options: [
			{
				model: 'paragraph',
				title: 'Paragraph',
				class: 'ck-heading_paragraph'
			},
			{
				model: 'heading1',
				view: 'h1',
				title: 'Heading 1',
				class: 'ck-heading_heading1'
			},
			{
				model: 'heading2',
				view: 'h2',
				title: 'Heading 2',
				class: 'ck-heading_heading2'
			},
			{
				model: 'heading3',
				view: 'h3',
				title: 'Heading 3',
				class: 'ck-heading_heading3'
			},
			{
				model: 'heading4',
				view: 'h4',
				title: 'Heading 4',
				class: 'ck-heading_heading4'
			},
			{
				model: 'heading5',
				view: 'h5',
				title: 'Heading 5',
				class: 'ck-heading_heading5'
			},
			{
				model: 'heading6',
				view: 'h6',
				title: 'Heading 6',
				class: 'ck-heading_heading6'
			}
		]
	},
	htmlSupport: {
		allow: [
			{
				name: /^.*$/,
				styles: true,
				attributes: true,
				classes: true
			}
		]
	},
	image: {
		toolbar: [
			'toggleImageCaption',
			'imageTextAlternative',
			'|',
			'imageStyle:inline',
			'imageStyle:wrapText',
			'imageStyle:breakText',
			'|',
			'resizeImage'
		]
	},
	language: 'fr',
	licenseKey: LICENSE_KEY,
	link: {
		addTargetToExternalLinks: true,
		defaultProtocol: 'https://',
		decorators: {
			toggleDownloadable: {
				mode: 'manual',
				label: 'Downloadable',
				attributes: {
					download: 'file'
				}
			}
		}
	},
	list: {
		properties: {
			styles: true,
			startIndex: true,
			reversed: true
		}
	},
	mention: {
		feeds: [
			{
				marker: '@',
				feed: [
					/* See: https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html */
				]
			}
		]
	},
	placeholder: 'Type or paste your content here!',
	style: {
		definitions: [
			{
				name: 'Article category',
				element: 'h3',
				classes: ['category']
			},
			{
				name: 'Title',
				element: 'h2',
				classes: ['document-title']
			},
			{
				name: 'Subtitle',
				element: 'h3',
				classes: ['document-subtitle']
			},
			{
				name: 'Info box',
				element: 'p',
				classes: ['info-box']
			},
			{
				name: 'CTA Link Primary',
				element: 'a',
				classes: ['button', 'button--green']
			},
			{
				name: 'CTA Link Secondary',
				element: 'a',
				classes: ['button', 'button--black']
			},
			{
				name: 'Marker',
				element: 'span',
				classes: ['marker']
			},
			{
				name: 'Spoiler',
				element: 'span',
				classes: ['spoiler']
			}
		]
	},
	table: {
		contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
	},
	translations: [translations]
};

console.log(document.querySelectorAll('textarea.ckeditor'));
function initCkeditors(context = document) {
    context.querySelectorAll('textarea.ckeditor').forEach((el) => {
        // éviter de ré-initialiser deux fois le même textarea
        if (!el.classList.contains('ck-editor-enabled')) {
            ClassicEditor.create(el, editorConfig, {
				licenseKey: LICENSE_KEY
			})
                .then(editor => {
                    el.classList.add('ck-editor-enabled');
                })
                .catch(error => console.error(error));
        }
    });
}

// Init au premier chargement
document.addEventListener('DOMContentLoaded', () => {
    initCkeditors();
});

// Ré-init quand EasyAdmin ajoute un élément dans une collection
document.addEventListener('ea.collection.item-added', (event) => {
    initCkeditors(event.target);
});

console.log("ckeditor initialised");