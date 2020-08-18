<select name="type"  class="form-control"  id="typeInput">
    @isset($type)
    <option value="{{$type}}"label="{{$type}}">{{$type}}</option>
    @endisset
    <option value="Custom" label="Custom">Custom</option>
    <option disabled>──────────</option>
    <option value="Cars"label="Cars">Cars</option>
    <option value="Education" label="Education">Education</option>
    <option value="Electronics" label="Electronics">Electronics</option>
    <option value="Fashion" label="Fashion">Fashion</option>
    <option value="Furniture" label="Furniture">Furniture</option>
    <option value="Investment" label="Investment">Investment</option>
    <option value="Luxury" label="Luxury">Luxury</option>
    <option value="Media" label="Media">Media</option>
    <option value="Money" label="Money">Money</option>
    <option value="Travel" label="Travel">Travel</option>
    <option value="Video Games" label="Video Games">Video Games</option>
</select>