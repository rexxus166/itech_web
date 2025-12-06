@if($quiz->questions->count() > 0)
            @php $nomor = 1; @endphp
            @foreach($quiz->questions as $data)
                <div class="modal fade" id="edit{{ $nomor }}" tabindex="-1" role="dialog" aria-labelledby="editLabel{{ $nomor }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form method="post" enctype="multipart/form-data" action="{{ route('admin.quiz.questions.update', [$quiz->id, $data->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editLabel{{ $nomor }}">Edit Soal {{ $nomor }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="soal{{ $nomor }}"><span class="text-danger">*</span>Soal</label>
                                        <textarea name="question_text" class="form-control" id="soal{{ $nomor }}">{{ $data->question_text }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="pembahasan_soal{{ $nomor }}">Pembahasan Soal</label>
                                        <textarea name="pembahasan_soal" class="form-control" id="pembahasan_soal{{ $nomor }}" rows="3">{{ old('pembahasan_soal', $data->pembahasan) }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @php
                                                $answers = $data->answers->keyBy('option');
                                            @endphp
                                            <div class="form-group">
                                                <label for="a{{ $nomor }}"><span class="text-danger">*</span>Jawaban A</label>
                                                <input type="text" name="answer_a" value="{{ $answers['A']->answer_text ?? '' }}" class="form-control" id="a{{ $nomor }}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="b{{ $nomor }}"><span class="text-danger">*</span>Jawaban B</label>
                                                <input type="text" name="answer_b" value="{{ $answers['B']->answer_text ?? '' }}" class="form-control" id="b{{ $nomor }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="c{{ $nomor }}"><span class="text-danger">*</span>Jawaban C</label>
                                                <input type="text" name="answer_c" value="{{ $answers['C']->answer_text ?? '' }}" class="form-control" id="c{{ $nomor }}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="d{{ $nomor }}"><span class="text-danger">*</span>Jawaban D</label>
                                                <input type="text" name="answer_d" value="{{ $answers['D']->answer_text ?? '' }}" class="form-control" id="d{{ $nomor }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="kunci{{ $nomor }}"><span class="text-danger">*</span>Kunci Jawaban</label>
                                        <select name="correct_answer" class="form-control" id="kunci{{ $nomor }}">
                                            <option {{ (isset($answers['A']) && $answers['A']->is_correct) ? 'selected' : '' }} value="A">A</option>
                                            <option {{ (isset($answers['B']) && $answers['B']->is_correct) ? 'selected' : '' }} value="B">B</option>
                                            <option {{ (isset($answers['C']) && $answers['C']->is_correct) ? 'selected' : '' }} value="C">C</option>
                                            <option {{ (isset($answers['D']) && $answers['D']->is_correct) ? 'selected' : '' }} value="D">D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary float-right pull-right" type="submit" name="edit" value="edit">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @php $nomor++; @endphp
            @endforeach
        @else
            <p>Tidak ada soal untuk kuis ini.</p>
        @endif

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addQuestionModal">Tambah Soal</button>

        <!-- Add Question Modal -->
        <div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.quiz.questions.store', $quiz->id) }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addQuestionModalLabel">Tambah Soal</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="soalNew"><span class="text-danger">*</span>Soal</label>
                                <textarea name="question_text" class="form-control" id="soalNew"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pembahasan_soalNew">Pembahasan Soal</label>
                                <textarea name="pembahasan_soal" class="form-control" id="pembahasan_soalNew" rows="3"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="aNew"><span class="text-danger">*</span>Jawaban A</label>
                                        <input type="text" name="answer_a" class="form-control" id="aNew" />
                                    </div>
                                    <div class="form-group">
                                        <label for="bNew"><span class="text-danger">*</span>Jawaban B</label>
                                        <input type="text" name="answer_b" class="form-control" id="bNew" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cNew"><span class="text-danger">*</span>Jawaban C</label>
                                        <input type="text" name="answer_c" class="form-control" id="cNew" />
                                    </div>
                                    <div class="form-group">
                                        <label for="dNew"><span class="text-danger">*</span>Jawaban D</label>
                                        <input type="text" name="answer_d" class="form-control" id="dNew" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kunciNew"><span class="text-danger">*</span>Kunci Jawaban</label>
                                <select name="correct_answer" class="form-control" id="kunciNew">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary float-right pull-right" type="submit" name="add" value="add">Tambah</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

</div>
@endsection
