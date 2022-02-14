<tr class="row-temporary">
	<td class="coa_pq">
		<?= $this->input->post('coa_pq') ?>
		<input type="hidden" name="coa_pq_hidden[]" value="<?= $this->input->post('coa_pq') ?>">
	</td>
	<td class="uraian">
		<?= $this->input->post('uraian') ?>
		<input type="hidden" name="uraian_hidden[]" value="<?= $this->input->post('uraian') ?>">
	</td>
	<td class="volume">
		<?= $this->input->post('volume') ?>
		<input type="hidden" name="volume_hidden[]" value="<?= $this->input->post('volume') ?>">
	</td>
	<td class="satuan">
		<?= $this->input->post('satuan') ?>
		<input type="hidden" name="satuan_hidden[]" value="<?= $this->input->post('satuan') ?>">
	</td>
	<td class="periode">
		<?= $this->input->post('periode') ?>
		<input type="hidden" name="periode_hidden[]" value="<?= $this->input->post('periode') ?>">
	</td>
	<td class="harga">
		<?= $this->input->post('harga') ?>
		<input type="hidden" name="harga_hidden[]" value="<?= $this->input->post('harga') ?>">
	</td>
	<td class="total">
		<?= $this->input->post('total') ?>
		<input type="hidden" name="total_hidden[]" value="<?= $this->input->post('total') ?>">
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="<?= $this->input->post('coa_pq_hidden') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>