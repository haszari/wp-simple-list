import { __ } from '@wordpress/i18n';
import apiFetch from '@wordpress/api-fetch';
import { render, useState, useEffect } from '@wordpress/element';

import { Autocomplete, Button, Grid, TextField } from '@mui/material';


function createNewItemPost( title, tagIDs ) {
	apiFetch( {
		path: '/wp/v2/posts/',
		method: 'POST',
		data: {
			title: title,
			tags: tagIDs,
			status: 'publish',
		},
	} ).then( ( res ) => {
		console.log( res );
	} );
}

function NewItemTags( { allTags = [], onChange = () => {} } ) {
	return (
		<Autocomplete
			multiple
			id="tags-standard"
			options={allTags}
			getOptionLabel={(option) => option.name}
			defaultValue={[]}
			onChange={( event, value ) => {
				onChange( value );
			} }
			renderInput={(params) => (
			<TextField
				{...params}
				variant="standard"
				label="tags"
			/>
			)}
		/>
	);
}

function AddItemForm() {
	const [title, setTitle] = useState('');
	const [tagIDs, setTagIDs] = useState([]);
	const [availableTags, setAvailableTags] = useState([]);

	useEffect(() => {
		apiFetch( {
			// Max out per-page; server limits 100 posts.
			// This is a reasonable max for typical use cases (<100 tags on site).
			path: '/wp/v2/tags/&per_page=100',
		} ).then( ( res ) => {
			setAvailableTags( res )
		} );
	}, [ setAvailableTags ] );

	return (
		<form>
			<Grid
				container
				spacing={1}
				alignItems="flex-end"
				columns={{ xs: 6, sm: 12, md: 12 }}
			>
				<Grid item xs={12}>
					<TextField
						fullWidth
						type="text"
						placeholder="name"
						value={title}
						onChange={ ( e ) => {
							setTitle( e.target.value );
						} }
					></TextField>
				</Grid>
				<Grid item xs={10}>
					<NewItemTags
						fullWidth
						allTags={availableTags}
						onChange={ ( selectedTags ) => {
							const tagIDs = selectedTags.map( o => o.id );
							setTagIDs( tagIDs );
						} }
					/>
				</Grid>
				<Grid item xs>
					<Button
						fullWidth
						variant="contained"
						type="submit"
						onClick={ ( e ) => {
							e.preventDefault();
							createNewItemPost( title, tagIDs );
						} }
					>Add</Button>
				</Grid>
			</Grid>
		</form>
	);
}

function showAddItemForm() {
	const firstAddForm = document.querySelector( '.cbr-add-item-form' );
	if ( ! firstAddForm ) {
		return;
	}
    render(
        <AddItemForm />,
        firstAddForm
    );

}

document.addEventListener("DOMContentLoaded", function(event) {
	showAddItemForm();
});

